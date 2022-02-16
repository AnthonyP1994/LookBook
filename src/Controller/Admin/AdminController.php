<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{

    protected function listEntities(ServiceEntityRepository $repository, String $name): Response
    {
        $entites = $repository->findAll();

        return $this->render("Admin/" . $name . "/index.html.twig", [
            'data' => $entites,
        ]);
    }




    protected function newEntity(Request $request, FormInterface $form, String $name, EntityManagerInterface $entityManager): Response
    {


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_' . $name . '_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/' . $name . '/create.html.twig', [
            'data' => $form->getData(),
            'form' => $form->createView(),
        ]);
    }


    //.....Controller
    protected function getEntityName(): String
    {
        $parts = explode("\\", $this::class);

        $last = end($parts);
        $tabLast = explode("Controller", $last);

        return $tabLast[0];
    }
}