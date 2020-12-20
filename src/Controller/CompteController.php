<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\Compte;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CompteType;

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

    /**
     * @Route("/compte/new", name="compte_new",  methods={"GET","POST"})
     *
     */
    public function new(Request $request): Response
    {
        $compte = new Compte();
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();

            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/new.html.twig', [
            'compte'=> $compte,
            'form' => $form->createView(),
        ]);
    }


}
