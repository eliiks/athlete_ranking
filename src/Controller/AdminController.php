<?php

namespace App\Controller;

use App\Entity\Administrator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/connexion",name="connexion")
     */
    public function connexionAction(AuthenticationUtils $authenticationUtils): Response
    {
        //Si déjà connecté, alors on redirige vers accueil admin
        if ($this->getUser()) {
             return $this->redirectToRoute('admin_accueil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion",name="deconnexion")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/admin/accueil", name="admin_accueil")
     */
    public function adminAccueilAction(ManagerRegistry $doctrine){

        return $this->render("accueil/index.html.twig");
    }
}
