<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Picture;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use App\Repository\CommentRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/wallpapers")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("", name="picture_index", methods={"GET"})
     * @param PictureRepository $pictureRepository
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, PictureRepository $pictureRepository, CategoryRepository $categoryRepository , Request $request ): Response
    {
        $query = $pictureRepository->findAll();
        $categories= $categoryRepository->findAll();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12
        );
        return $this->render('picture/index.html.twig', [
            'pictures' => $pagination, 'categories'=>$categories, 'filter' => null
        ]);
    }

    /**
     * @Route("/filter={category}", name="picture_index_filter", methods={"GET"})
     * @param PictureRepository $pictureRepository
     * @param Request $request
     * @return Response
     */
    public function indexFilter(PaginatorInterface $paginator, PictureRepository $pictureRepository, CategoryRepository $categoryRepository , Request $request, Category $category ): Response
    {
        $cat = $category->getId();
        $query = $pictureRepository->createQueryBuilder('p')
            ->innerJoin('p.picture_categories', 'c')
            ->where('c.id = :category')
            ->setParameter(':category', $cat)
            ->getQuery()->getResult();
        $categories= $categoryRepository->findAll();

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12
        );

        return $this->render('picture/index.html.twig', [
            'pictures' => $pagination, 'categories'=>$categories, 'filter' =>$category
        ]);
    }

    /**
     * @Route("/new", name="picture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();
            $this->addFlash('success', 'Picture created');
            return $this->redirectToRoute('picture_index');
        }

        return $this->render('picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="picture_show", methods={"GET", "POST"})
     */
    public function show(Request $request, Picture $picture, PictureRepository $pictureRepository, CommentRepository $commentRepository ): Response
    {
        $categories = $pictureRepository->createQueryBuilder('p')
            ->select( 'c.category')
            ->innerJoin('p.picture_categories', 'c')
            ->where('p.id = :id')
            ->setParameter(':id', $picture->getId())
            ->getQuery()->getResult();

        $comments = $commentRepository->createQueryBuilder('c')
            ->select('c')
            ->innerJoin('c.picture', 'p')
            ->where('p.id = :id')
            ->setParameter(':id', $picture->getId())
            ->orderBy('c.date', 'Desc')
            ->getQuery()->getResult();

        $comment = new Comment();
        $comment->setUser($user = $this->getUser());
        $comment->setPicture($picture);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
            $this->addFlash('success', 'Comment was successfully created');
            return $this->redirectToRoute('picture_show', ['id' => $picture->getId()]);
        }
        return $this->render('picture/show.html.twig', ['picture' => $picture, 'categories' => $categories, 'comments' => $comments, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}/edit", name="picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Picture $picture): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->remove('file');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Picture updated');
            return $this->redirectToRoute('picture_show', ['id' => $picture->getId()]);

        }
        return $this->render('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="picture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Picture $picture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }
        $this->addFlash('success', 'Picture deleted');
        return $this->redirectToRoute('picture_index');
    }
}
