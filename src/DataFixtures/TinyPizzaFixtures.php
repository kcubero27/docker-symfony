<?php

namespace App\DataFixtures;

use App\Entity\TinyPizza;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TinyPizzaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tinyPizzaHawaiana = new TinyPizza();
        $tinyPizzaHawaiana->setName("Hawaiana");
        $manager->persist($tinyPizzaHawaiana);

        $tinyPizzaPepperoni = new TinyPizza();
        $tinyPizzaPepperoni->setName("Pepperoni");
        $manager->persist($tinyPizzaPepperoni);

        $manager->flush();
    }
}
