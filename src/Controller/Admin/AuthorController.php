<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AdminController
{

    /**
     * @Route("/admin/auteurs",name="app_admin_author_list")
     */
    public function list(AuthorRepository $repoAuthor): Response
    {
        $name = $this->getEntityName();
        return $this->listEntities($repoAuthor, $name);
    }

    /**
     * @Route("/admin/auteurs/creer",name="app_admin_author_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(AuthorType::class, null);

        return $this->newEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/auteurs/{id}/modifier",name="app_admin_author_edit")
     */
    public function edit(Request $request, Author $author, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(AuthorType::class, $author);

        return $this->editEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/auteurs/{id}/supprimer",name="app_admin_author_delete")
     */
    public function delete(EntityManagerInterface $manager,  Author $author): Response
    {
        $name = $this->getEntityName();

        return $this->deleteEntity($author, $name, $manager);
    }
}