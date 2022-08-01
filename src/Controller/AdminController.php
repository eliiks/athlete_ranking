<?php

namespace App\Controller;

use App\Entity\Administrator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/connexion",name="_connexion")
     */
    public function connexionAction(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
             return $this->redirectToRoute('accueil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/check", name="_check")
     */
    public function checkAction(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher){
        $user = $doctrine->getManager()->getRepository('App\Entity\Administrator')->find(19);

        if(isset($user)){
            if($passwordHasher->isPasswordValid($user,'dieu')){
                dump($user);
            }else{
                dump("shit");
            }
        }

        return $this->render("accueil/index.html.twig");
    }

    /**
     * @Route("/deconnexion",name="_deconnexion")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
