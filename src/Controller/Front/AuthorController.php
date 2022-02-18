<?php

declare(strict_types=1);

namespace App\Controller\Front;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
    /**
     * @Route("/auteurs", name="app_front_author_list")
     */
    public function list(AuthorRepository $repository): Response
    {
        $authors = $repository->findAll();

        return $this->render('Front/Author/list.html.twig', [
            'authors' => $authors,
        ]);
    }

    /**
     * @Route("/auteurs/{id}", name="app_front_author_show")
     */
    public function showAuthor(Author $author): Response
    {
        return $this->render('Front/Author/show.html.twig', [
            'author' => $author,
        ]);
    }
}