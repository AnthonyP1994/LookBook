<?php

declare(strict_types=1);

namespace App\Controller\Admin;

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
     * @Route("/list",name="app_admin_user_list")
     */
    public function list(UserRepository $repoUser): Response
    {
        $name = $this->getEntityName();
        return $this->listEntities($repoUser, $name);
    }

    /**
     * @Route("/create",name="app_admin_user_create")
     */
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $name = strtolower($this->getEntityName());
        $form = $this->createForm(UserType::class, null);
        dump($form);
        return $this->newEntity($request, $form, $name, $manager);
    }
}