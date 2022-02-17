<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Publisher;
use App\Form\PublisherType;
use App\Repository\PublisherRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublisherController extends AdminController
{

    /**
     * @Route("/admin/maisons-edition",name="app_admin_publisher_list")
     */
    public function list(PublisherRepository $repoPublisher): Response
    {
        $name = $this->getEntityName();
        return $this->listEntities($repoPublisher, $name);
    }

    /**
     * @Route("/admin/maisons-edition/creer",name="app_admin_publisher_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(PublisherType::class, null);

        return $this->newEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/maisons-edition/{id}/modifier",name="app_admin_publisher_edit")
     */
    public function edit(Request $request, Publisher $publisher, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(PublisherType::class, $publisher);

        return $this->editEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/maisons-edition/{id}/supprimer",name="app_admin_publisher_delete")
     */
    public function delete(EntityManagerInterface $manager,  Publisher $publisher): Response
    {
        $name = $this->getEntityName();

        return $this->deleteEntity($publisher, $name, $manager);
    }
}