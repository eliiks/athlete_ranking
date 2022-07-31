<?php

namespace App\DataFixtures;

use App\Entity\Administrator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdministratorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//
//         $manager->persist($admin);
//         $manager->flush();
    }
}
