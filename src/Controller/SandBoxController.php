<?php

namespace App\Controller;

use App\Entity\Category;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @Route("/sandbox", name="sandbox")
 */
class SandBoxController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function indexAction(): Response
    {
        return $this->render('sand_box/index.html.twig', [
            'controller_name' => 'SandBoxController',
        ]);
    }

    /**
     * @Route("/add", name="_add")
     */
    public function addAction(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $cat = new Category();
        $cat->setLongName("connard");
        $cat->setShortName("con");
        $cat->setDescription("Louis-Xavier GODET est un connard");
        $em->persist($cat); //l'objet doctrine devient responsable de cat, donc c'est lui qui s'occupe
        $em->flush(); //ajoute reellement à la base
        return  $this->redirectToRoute("sandbox_index");
    }
}
