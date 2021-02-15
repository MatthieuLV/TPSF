<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_default")
     */
    public function homepage(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/utilisateurs", name="app_user_index")
     */
    public function userIndex(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="app_user_show", requirements={"id"="\d+"})
     * @param int $id
     * @return Response
     */
    public function userShow(int $id): Response
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $id]);
        return $this->render('user/view.html.twig', [
            'user' => $user
        ]);
    }
}