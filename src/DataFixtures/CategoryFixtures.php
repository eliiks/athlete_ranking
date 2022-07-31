<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $categorie = new Category();
         $categorie->setLongName("ESPOIR");
         $categorie->setShortName("ESP");
         $manager->persist($categorie);

        $manager->flush();
    }
}
