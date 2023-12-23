<?php

namespace FitTrackerApi\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use FitTrackerApi\Entity\Exercise;
use FitTrackerApi\Entity\Unit;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {



        $reps = new Unit();
        $reps->setTitle('Repetitions')
            ->setAbbreviation('reps')
            ->setColor('#3880ff')
            ->setMin(0)
            ->setMax(30)
            ->setTickInterval(1);
        $manager->persist($reps);
        $manager->flush();

        $weight = new Unit();
        $weight->setTitle('Weight')
            ->setAbbreviation('kgs')
            ->setColor('#3dc2ff')
            ->setMin(0)
            ->setMax(200)
            ->setTickInterval(1);
        $manager->persist($weight);
        $manager->flush();

        $distance = new Unit();
        $distance->setTitle('Distance')
            ->setAbbreviation('kms')
            ->setColor('#2dd36f')
            ->setMin(0)
            ->setMax(50)
            ->setTickInterval(1);
        $manager->persist($distance);
        $manager->flush();
            
        $speed = new Unit();
        $speed->setTitle('Speed')
            ->setAbbreviation('km/h')
            ->setColor('#ffc409')
            ->setMin(0)
            ->setMax(50)
            ->setTickInterval(1);
        $manager->persist($speed);
        $manager->flush();

        $kcal = new Unit();
        $kcal->setTitle('Calories')
            ->setAbbreviation('kCals')
            ->setColor('#eb445a')
            ->setMin(0)
            ->setMax(1000)
            ->setTickInterval(1);
        $manager->persist($kcal);
        $manager->flush();
        
        $minPerKm = new Unit();
        $minPerKm->setTitle('Rythm')
            ->setAbbreviation('min/km')
            ->setColor('#5260ff')
            ->setMin(0)
            ->setMax(1000)
            ->setTickInterval(1);
        $manager->persist($minPerKm);
        $manager->flush();

        $exercise = new Exercise();
        $exercise->setTitle('Shoulder press')
            ->addUnit($reps)
            ->addUnit($weight)
            ->setDescription('The overhead press, also known as the shoulder press or military press, is an upper-body weight training exercise in which the trainee presses a weight overhead while seated or standing. It is mainly used to develop the anterior deltoid muscles of the shoulder.')
            ->setMiniature('shoulderpress.webp');
        $manager->persist($exercise);
        $manager->flush();

        $exercise = new Exercise();
        $exercise->setTitle('Curl')
            ->addUnit($reps)
            ->addUnit($weight)
            ->setDescription('A bicep curl usually starts with the arm in a fully extended position, holding a weight with a supinated (palms facing up) grip. A full repetition consists of bending or "curling" the elbow until it is fully flexed, then slowly lowering the weight to the starting position.')
            ->setMiniature('curl.jpg');
        $manager->persist($exercise);
        $manager->flush();

        $exercise = new Exercise();
        $exercise->setTitle('Chest press')
            ->addUnit($reps)
            ->addUnit($weight)
            ->setDescription('The bench press, or chest press, is a weight training exercise where a person presses a weight upwards while lying horizontally on a weight training bench. Although the bench press is a compound movement, the muscles primarily used are the pectoralis major, the anterior deltoids, and the triceps, among other stabilizing muscles. A barbell is generally used to hold the weight, but a pair of dumbbells can also be used.')
            ->setMiniature('chestpress.jpg');
        $manager->persist($exercise);
        $manager->flush();

        $exercise = new Exercise();
        $exercise->setTitle('Treadmill')
            ->addUnit($distance)
            ->addUnit($speed)
            ->addUnit($kcal)
            ->addUnit($minPerKm)
            ->setDescription('A treadmill is a stationary exercise machine that features a walking or running belt designed for indoor cardio exercise. Many treadmills offer a range of speed and incline settings, making them accessible pieces of fitness equipment for individuals at any cardio fitness level.')
            ->setMiniature('treadmill.jpg');
        $manager->persist($exercise);
        $manager->flush();
    }
}
