<?php

namespace App\DataFixtures;

use App\Entity\Booking;
use App\Entity\Classroom;
use App\Entity\Customer;
use App\Entity\Equipment;
use App\Entity\Software;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $admin = new User();
            $admin->setName('Martin')
            ->setEmail('admin@admin.fr')
            ->setPassword($faker->password)
            ->setCorporateName($faker->company)
            ->setSiret($faker->isbn13)
            ->setPhone($faker->phoneNumber)
            ->setAddress($faker->address)
            ->setCity($faker->city)
            ->setZip($faker->postcode)
            ->setCountry($faker->country)
            ->setRoles(['ROLE_ADMIN']);
            
            $manager->persist($admin);
        }

        $clients = [];

        for ($i = 0; $i < 10; $i++) {
            $client = new User();
            $client->setName($faker->name)
            ->setEmail($faker->email)
            ->setPassword($faker->password)
            ->setCorporateName($faker->company)
            ->setSiret($faker->isbn13)
            ->setPhone($faker->phoneNumber)
            ->setAddress($faker->address)
            ->setCity($faker->city)
            ->setZip($faker->postcode)
            ->setCountry($faker->country)
            ->setRoles(['ROLE_USER']);

            $manager->persist($client);

            array_push($clients, $client);
        }

        $equipments = [];

        for ($i = 0; $i < 10; $i++) {
            $equipment = new Equipment();
            $equipment->setAdmin($admin);
            $equipment->setOption($faker->boolean);
            $equipment->setCreatedAt($faker->dateTimeThisYear);
            $equipment->setUpdatedAt($faker->dateTimeThisYear);
        
            $manager->persist($equipment);
            array_push($equipments, $equipment);
        }

        for ($i = 0; $i < 5; $i++) {
            $classroom = new Classroom();
            $classroom->setAdmin($admin);
            $classroom->setName('Classroom ' . $i);
            $classroom->setDescription($faker->text);
            $classroom->setAddress($faker->address);
            $classroom->setCity($faker->city);
            $classroom->setZip($faker->postcode);
            $classroom->setCountry($faker->country);
            $classroom->setGauge($faker->randomNumber(2));
            $classroom->setFloor($faker->word);
            $classroom->setParking($faker->boolean);
            $classroom->setPrice($faker->randomNumber(3));
            $classroom->setStatus($faker->boolean);
            $classroom->addEquipment($faker->randomElement($equipments));

            $manager->persist($classroom);
        }

        for ($i = 0; $i < 15; $i++) {
            $booking = new Booking();
            
            $booking->setClient($client);

            $booking->setClient($faker->randomElement($clients));
            $booking->setStartDate($faker->dateTimeThisMonth);
            $booking->setEndDate($faker->dateTimeThisMonth);
            $booking->setAmount($faker->randomFloat(2, 50, 500));
            $booking->setStatus($faker->boolean);
            $booking->setCreatedAt($faker->dateTimeThisYear);
            $booking->setUpdatedAt($faker->dateTimeThisYear);
            $booking->setNumber('Booking-' . $i);

            $manager->persist($booking);


            for ($j = 0; $j < 2; $j++) {
                $customer = new Customer();

                $customer->setEffective($faker->randomNumber(1));
                $customer->setCreatedAt($faker->dateTimeThisYear);
                $customer->setBooking($booking);

                $manager->persist($customer);
            }
        }

        $manager->flush();
    
    for ($i = 0; $i < 10; $i++) {
        $software = new Software();

        $software->setSoftwareName($faker->text(20))
        ->setVersion($faker->randomElement(['1.0', '2.0', '3.0', null]))
        ->setDescription($faker->text)
        ->setYear($faker->numberBetween(2000, 2022));

        $manager->persist($software);
        }
    } 

}


