<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AdminController
{

    /**
     * @Route("/listUser",name="app_admin_user_list")
     */
    public function list(UserRepository $repoUser): Response
    {
        dump("test");
        $name = $this->getEntityName();
        return $this->listEntities($repoUser, $name);
    }

    /**
     * @Route("/createUser",name="app_admin_user_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = strtolower($this->getEntityName());
        $form = $this->createForm(UserType::class, null);
        dump($form);
        return $this->newEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/editUser/{id}",name="app_admin_user_edit")
     */
    public function edit(Request $request, User $user, EntityManagerInterface $manager): Response
    {
        dump("hello");
        dump($user);
        $name = strtolower($this->getEntityName());
        $form = $this->createForm(UserType::class, $user);

        return $this->editEntity($request, $form, $name, $manager);
    }

    /**
     * @Route("/deleteUser/{id}",name="app_admin_user_delete")
     */
    public function delete(EntityManagerInterface $manager,  User $user): Response
    {
        dump($user);
        $name = $this->getEntityName();

        return $this->deleteEntity($user, $name, $manager);
    }
}