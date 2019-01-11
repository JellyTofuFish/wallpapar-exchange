<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/registration", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $user->setPoints('10');
        $user->setRoles(array('ROLE_USER'));
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            $this->addFlash('success', 'Successfully registered');
            return $this->redirectToRoute('main_page');
        }

        return $this->render(
            'registration/registration.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        $message = "";


        if ($this->isGranted('ROLE_USER')) {

            $entityManager = $this->getDoctrine()->getManager();

            $user = $this->getUser();
            $dateNow= \DateTime::createFromFormat('U', time());
            $dateDiff = date_diff($dateNow, $user->getLastDateOnline());
            if ($dateDiff->days > 1) {
                $entityManager = $this->getDoctrine()->getManager();
                $points = $user->getPoints();
                $points += 5;
                $user->setPoints($points);
                $user->setLastDateOnline($dateNow);
                $entityManager->flush();
                $message = "Welcome back! Added 5 points for today's login";
            }
            else {
                $message = "Greetings!";
            }
            return $this->render('main_page/index.html.twig', ['message' => $message] );

        }
        else {
            return $this->render('main_page/index.html.twig', ['message' => $message]);
        }
    }

}
