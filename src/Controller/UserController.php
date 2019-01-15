<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
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

        $user->setPoints('15');
        $user->setRoles(array('ROLE_USER'));
        $dateNow = \DateTime::createFromFormat('U', time());
        $user->setLastDateOnline($dateNow);
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
            'user/registration.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/", name="main_page")
     */
    public function index()
    {
        $message = "Greetings!";
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($this->isGranted('ROLE_USER')) {
            $dateNow = \DateTime::createFromFormat('U', time());
            $dateDiff = date_diff($dateNow, $user->getLastDateOnline());
            if ($dateDiff->days > 1) {
                $points = $user->getPoints();
                $points += 5;
                $user->setPoints($points);
                $user->setLastDateOnline($dateNow);
                $entityManager->flush();
                $message = "Welcome back! Added 5 points for today's login";
            } else {
                $message = "Greetings!";
            }
        }
        return $this->render('main_page/index.html.twig', ['message' => $message]);
    }

    /**
     * @Route("user/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserRepository $userRepository)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->remove('plainPassword');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'User data updated');
            return $this->redirectToRoute('main_page');

        }
        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
