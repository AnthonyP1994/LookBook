<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\SubscriptionType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserController extends AbstractController
{
    /**
     * @Route("/connexion", name="app_front_user_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/inscription", name="app_front_user_subscription")
     */
    public function subscription(Request $request,  UserPasswordHasherInterface $crypter,    EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(SubscriptionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            // Cryptage du mot de passe
            $user->setPassword($crypter->hashPassword(
                $user,
                $user->getPassword(),
            ));

            // Enregistrement dans la base de données
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', "Votre insertion a bien été prise en compte )");

            // @TODO Rediriger vers la page de connexion
            return new Response('Inscription OK');
        }

        return $this->render('Front/User/subscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profils/{id}", name="app_front_user_showProfile")
     */
    public function showProfile(User $user): Response
    {
        return $this->render('Front/showProfile.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/mon-profil", name="app_front_user_myProfile")
     */
    public function myProfile(): Response
    {
        $user = $this->getUser();
        return $this->render('Front/User/myProfile.html.twig', [
            'user' => $user,
        ]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/", name="app_front_user_home")
     */
    public function home(): Response
    {
        return $this->render('Front/home.html.twig');
    }

    /**
     * @Route("/profils", name="app_front_user_showAllProfiles")
     */
    public function showAllProfiles(UserRepository $repository): Response
    {
        $users = $repository->findAll();

        return $this->render(
            'Front/showAllProfiles.html.twig',
            ['users' => $users]
        );
    }
}
