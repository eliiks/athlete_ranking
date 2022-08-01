<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $categorieBB = new Category();
        $categorieBB->setLongName("Baby Athlé");
        $categorieBB->setShortName("BB");
        $manager->persist($categorieBB);

        $categorieEA = new Category();
        $categorieEA->setLongName("École d'Athlétisme");
        $categorieEA->setShortName("EA");
        $manager->persist($categorieEA);

        $categoriePO = new Category();
        $categoriePO->setLongName("Poussins");
        $categoriePO->setShortName("PO");
        $manager->persist($categoriePO);

        $categorieBE = new Category();
        $categorieBE->setLongName("Benjamins");
        $categorieBE->setShortName("BE");
        $manager->persist($categorieBE);

        $categorieMI = new Category();
        $categorieMI->setLongName("Minimes");
        $categorieMI->setShortName("MI");
        $manager->persist($categorieMI);

        $categorieCA = new Category();
        $categorieCA->setLongName("Cadets");
        $categorieCA->setShortName("CA");
        $manager->persist($categorieCA);

        $categorieJU = new Category();
        $categorieJU->setLongName("Juniors");
        $categorieJU->setShortName("JU");
        $manager->persist($categorieJU);

        $categorieES = new Category();
        $categorieES->setLongName("Espoirs");
        $categorieES->setShortName("ES");
        $manager->persist($categorieES);

        $categorieSE = new Category();
        $categorieSE->setLongName("Seniors");
        $categorieSE->setShortName("SE");
        $manager->persist($categorieSE);

        $categorieMA = new Category();
        $categorieMA->setLongName("Master");
        $categorieMA->setShortName("MA");
        $manager->persist($categorieMA);

        $manager->flush();
    }
}
