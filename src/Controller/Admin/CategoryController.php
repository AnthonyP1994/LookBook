<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AdminController
{
    /**
     * @Route("/admin/categories", name="app_admin_category_list")
     */
    public function list(CategoryRepository $repository): Response
    {
        $name = $this->getEntityName();
        return $this->listEntities($repository, $name);
    }

    /**
     * @Route("/admin/categories/creer", name="app_admin_category_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(CategoryType::class, null);

        return $this->newEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/categories/{id}/modifier", name="app_admin_category_edit")
     */
    public function edit(Request $request, Category $category, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(CategoryType::class, $category);

        return $this->editEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/categories/{id}/supprimer", name="app_admin_category_delete")
     */
    public function delete(EntityManagerInterface $manager,  category $category): Response
    {
        $name = $this->getEntityName();

        return $this->deleteEntity($category, $name, $manager);
    }
}
