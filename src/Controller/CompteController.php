<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserRepository $userRepository)
    {
        return $this->render('compte/index.html.twig', [
            'user' => $userRepository->findAll(),
        ]);
    }
}
