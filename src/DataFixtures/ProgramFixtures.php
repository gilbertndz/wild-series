<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        {
        $program = new Program();
        $program->setTitle('Walking Dead');
        $program->setSynopsis('Walking Dead est un série télévisée américaine créée par Damon Lindelof et David Benioff, qui se succède à la série Breaking Bad, qui a été réalisée par Steven Lisberger et Vince Gilligan. La série se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans. La série se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans.');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Breaking Bad');
        $program->setSynopsis('Breaking Bad est un western américain réalisé par Vince Gilligan et écrit par Vince Gilligan. Il est sorti en 2008 et est le deuxième épisode de la série. Il est le deuxième épisode de la série. Il est le deuxième épisode de la série.');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Desperate Housewives');
        $program->setSynopsis('Desperate Housewives est une série télévisée américaine créée par Vince Gilligan et écrite par Vince Gilligan. Elle se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans. Elle se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans.');
        $program->setCategory($this->getReference('category_Comédie'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Dr House');
        $program->setSynopsis('Dr House est une série télévisée américaine créée par Vince Gilligan et écrite par Vince Gilligan. Elle se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans. Elle se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans.');
        $program->setCategory($this->getReference('category_Comédie'));
        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Game of Thrones');
        $program->setSynopsis('Game of Thrones est une série télévisée américaine créée par Vince Gilligan et écrite par Vince Gilligan. Elle se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans. Elle se déroule sur deux continents, dans le monde entier, et se déroule sur une période de deux ans.');
        $program->setCategory($this->getReference('category_Drame'));
        $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
