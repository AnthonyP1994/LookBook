<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AdminController
{
    /**
     * @Route("/admin/livres",name="app_admin_book_list")
     */
    public function list(BookRepository $repoBook): Response
    {
        $name = $this->getEntityName();
        return $this->listEntities($repoBook, $name);
    }

    /**
     * @Route("/admin/livres/creer",name="app_admin_book_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(BookType::class, null);

        return $this->newEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/livres/{id}/modifier",name="app_admin_book_edit")
     */
    public function edit(Request $request, Book $book, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(BookType::class, $book);

        return $this->editEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/livres/{id}/supprimer", name="app_admin_book_delete")
     */
    public function delete(EntityManagerInterface $manager, Book $book): Response
    {
        $name = $this->getEntityName();

        return $this->deleteEntity($book, $name, $manager);
    }
}