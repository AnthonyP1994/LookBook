<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends AdminController
{

    /**
     * @Route("/admin/adresses",name="app_admin_address_list")
     */
    public function list(AddressRepository $repoAddress): Response
    {
        $name = $this->getEntityName();
        return $this->listEntities($repoAddress, $name);
    }

    /**
     * @Route("/admin/adresses/creer",name="app_admin_address_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(AddressType::class, null);

        return $this->newEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/adresses/{id}/modifier",name="app_admin_address_edit")
     */
    public function edit(Request $request, Address $address, EntityManagerInterface $manager): Response
    {
        $name = $this->getEntityName();
        $form = $this->createForm(AddressType::class, $address);

        return $this->editEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/admin/adresses/{id}/supprimer",name="app_admin_address_delete")
     */
    public function delete(EntityManagerInterface $manager,  Address $address): Response
    {
        $name = $this->getEntityName();

        return $this->deleteEntity($address, $name, $manager);
    }
}