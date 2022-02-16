<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use App\Controller\Admin\AdminController;
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
}