<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            $actor = new Actor();
            //Ce Faker va nous permettre d'alimenter l'instance de Episode que l'on souhaite ajouter en base
            $actor->setName($faker->name(10));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, 5)));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, 5)));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(0, 5)));

            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
