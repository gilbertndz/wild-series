<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 50; $i++) {
            $episode = new Episode();
            //Ce Faker va nous permettre d'alimenter l'instance de Episode que l'on souhaite ajouter en base
            $episode->setTitle($faker->sentence(3));
            $episode->setSynopsis($faker->paragraphs(3, true));
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(1, 10)));

            $manager->persist($episode);
            $this->addReference('episode_' . $i, $episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
