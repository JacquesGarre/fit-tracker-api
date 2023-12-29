<?php

namespace FitTrackerApi\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use FitTrackerApi\Entity\Exercise;
use FitTrackerApi\Entity\ExerciseType;
use FitTrackerApi\Entity\MuscleGroup;
use FitTrackerApi\Entity\Unit;
use Symfony\Component\String\Slugger\AsciiSlugger;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $slugger = new AsciiSlugger();

        $weight = new Unit();
        $weight->setTitle('Weight')
            ->setAbbreviation('kgs')
            ->setColor('#3dc2ff')
            ->setMin(0)
            ->setMax(200)
            ->setTickInterval(1);
        $manager->persist($weight);
        $manager->flush();

        $reps = new Unit();
        $reps->setTitle('Repetitions')
            ->setAbbreviation('reps')
            ->setColor('#3880ff')
            ->setMin(0)
            ->setMax(30)
            ->setTickInterval(1);
        $manager->persist($reps);
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

        $time = new Unit();
        $time->setTitle('Time')
            ->setAbbreviation('mins')
            ->setColor('#3880ff')
            ->setMin(0)
            ->setMax(120)
            ->setTickInterval(1);
        $manager->persist($time);
        $manager->flush();

        $kcals = new Unit();
        $kcals->setTitle('Calories')
            ->setAbbreviation('kCals')
            ->setColor('#eb445a')
            ->setMin(0)
            ->setMax(1000)
            ->setTickInterval(1);
        $manager->persist($kcals);
        $manager->flush();

        $shoulders = new MuscleGroup();
        $shoulders->setTitle('Shoulders');
        $manager->persist($shoulders);
        $manager->flush();

        $biceps = new MuscleGroup();
        $biceps->setTitle('Biceps');
        $manager->persist($biceps);
        $manager->flush();

        $legs = new MuscleGroup();
        $legs->setTitle('Legs');
        $manager->persist($legs);
        $manager->flush();

        $chest = new MuscleGroup();
        $chest->setTitle('Chest');
        $manager->persist($chest);
        $manager->flush();

        $arms = new MuscleGroup();
        $arms->setTitle('Arms');
        $manager->persist($arms);
        $manager->flush();

        $back = new MuscleGroup();
        $back->setTitle('Back');
        $manager->persist($back);
        $manager->flush();

        $core = new MuscleGroup();
        $core->setTitle('Core');
        $manager->persist($core);
        $manager->flush();

        $triceps = new MuscleGroup();
        $triceps->setTitle('Triceps');
        $manager->persist($triceps);
        $manager->flush();

        $fullbody = new MuscleGroup();
        $fullbody->setTitle('Full body');
        $manager->persist($fullbody);
        $manager->flush();

        $abs = new MuscleGroup();
        $abs->setTitle('Abs');
        $manager->persist($abs);
        $manager->flush();

        $calves = new MuscleGroup();
        $calves->setTitle('Calves');
        $manager->persist($calves);
        $manager->flush();

        $hamstrings = new MuscleGroup();
        $hamstrings->setTitle('Hamstrings');
        $manager->persist($hamstrings);
        $manager->flush();

        $glutes = new MuscleGroup();
        $glutes->setTitle('Glutes');
        $manager->persist($glutes);
        $manager->flush();

        $hips = new MuscleGroup();
        $hips->setTitle('Hips');
        $manager->persist($hips);
        $manager->flush();

        $forearms = new MuscleGroup();
        $forearms->setTitle('Forearms');
        $manager->persist($forearms);
        $manager->flush();

        $grip = new MuscleGroup();
        $grip->setTitle('Grip');
        $manager->persist($grip);
        $manager->flush();

        $cardio = new MuscleGroup();
        $cardio->setTitle('Cardio');
        $manager->persist($cardio);
        $manager->flush();



        $freeweight = new ExerciseType();
        $freeweight->setTitle('Free Weight');
        $manager->persist($freeweight);
        $manager->flush();

        $machine = new ExerciseType();
        $machine->setTitle('Machine');
        $manager->persist($machine);
        $manager->flush();

        $bodyweight = new ExerciseType();
        $bodyweight->setTitle('Bodyweight');
        $manager->persist($bodyweight);
        $manager->flush();

        $medicineball = new ExerciseType();
        $medicineball->setTitle('Medicine ball');
        $manager->persist($medicineball);
        $manager->flush();

        $battlerope = new ExerciseType();
        $battlerope->setTitle('Battle Rope');
        $manager->persist($battlerope);
        $manager->flush();

        $cardiovascular = new ExerciseType();
        $cardiovascular->setTitle('Cardiovascular');
        $manager->persist($cardiovascular);
        $manager->flush();

        $sled = new ExerciseType();
        $sled->setTitle('Sled');
        $manager->persist($sled);
        $manager->flush();

        $json = file_get_contents(dirname(__FILE__).'/exercises.json');
        $exercises = json_decode($json, true);
        foreach($exercises as $exercise){

            $units = explode(', ', $exercise['unit']);
            $picture = $slugger->slug(strtolower($exercise['title']));

            $ex = new Exercise();
            $ex->setTitle($exercise['title'])
                ->setDescription($exercise['description'])
                ->setMiniature($picture.'.jpg')
                ->setDifficulty($exercise['difficulty']);

            foreach($units as $unitString){
                $ex->addUnit($$unitString);
            }

            $mg = explode(', ', $exercise['muscleGroup']);
            foreach($mg as $muscle){
                $muscleGroupTitle = str_replace(' ', '', strtolower($muscle));
                $ex->addMuscleGroup($$muscleGroupTitle);
            }

            $types = explode(', ', $exercise['type']);
            foreach($types as $type){
                $typeTitle = str_replace(' ', '', strtolower($type));
                $ex->addType($$typeTitle);
            }
            $manager->persist($ex);
            $manager->flush();
        }
    }
}
