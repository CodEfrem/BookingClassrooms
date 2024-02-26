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

        // Set admin
            $admin = new User();
            $admin->setName('Martin')
                ->setEmail('admin@admin.fr')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword('$2y$13$h4KU/rGrzXn0xj4dNN8Q7uRF.oH1YIA/51KGc/3ae/FoOL1fNI9VW')
                ->setCorporateName($faker->company)
                ->setSiret($faker->siret)
                ->setPhone($faker->phoneNumber)
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setZip($faker->postcode)
                ->setCountry($faker->country);
            $manager->persist($admin);

            // Set client
        $clients = [];
        for ($i = 0; $i < 8; $i++) {
            $name = $faker->Lastname();
            $client = new User();
            $client->setName($name)
                ->setCorporateName($faker->company)
                ->setEmail($name . '@' . $faker->freeEmailDomain())
                ->setRoles(['ROLE_USER'])
                ->setPassword('$2y$13$h4KU/rGrzXn0xj4dNN8Q7uRF.oH1YIA/51KGc/3ae/FoOL1fNI9VW')
                ->setSiret($faker->siret)
                ->setPhone($faker->phoneNumber) 
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setZip($faker->postcode)
                ->setCountry($faker->country);
            $manager->persist($client);
            array_push($clients, $client);
        }

        // Set software
        $softwares = [];
        for ($i = 0; $i < 8; $i++) {
            $software = new Software();
            $software->setSoftwareName($faker->word)
                ->setVersion($faker->semver)
                ->setDescription($faker->text)
                ->setYear($faker->numberBetween(2000, 2022));
            $manager->persist($software);
            array_push($softwares, $software);
            }

        // Set equipments
        $equipments = [];
        for ($i = 0; $i < 10; $i++) {
            $equipment = new Equipment();
            $equipment->setAdmin($admin)
                ->setOption($faker->word)
                // ->addSoftware($faker->randomElement($softwares))
                ->setCreatedAt($faker->dateTimeThisYear)
                ->setUpdatedAt($faker->dateTimeThisYear);
            $manager->persist($equipment);
            array_push($equipments, $equipment);
        }

        // Set customer
        for ($j = 0; $j < 50; $j++) {
            $customer = new Customer();
            $customer->setEffective($faker->numberBetween(10, 30))
                ->setCreatedAt($faker->dateTimeThisYear);
            $manager->persist($customer);
        }

        // Set classrooms
        for ($i = 0; $i < 100; $i++) {
            $classroom = new Classroom();
            $classroom->setAdmin($admin)
                ->setName('Classroom ' . $i)
                ->setDescription($faker->text)
                ->setAddress($faker->address)
                ->setCity($faker->city)
                ->setZip($faker->postcode)
                ->setCountry($faker->country)
                ->setGauge($faker->randomNumber(2))
                ->setFloor($faker->numberBetween(0, 10))
                ->setParking($faker->boolean)
                ->setPrice($faker->numberBetween(3000, 50000))
                ->setStatus($faker->boolean)
                ->setImage(rand(0,1) ? 'default.jpg' : 'default-1.jpg')
                ->addEquipment($faker->randomElement($equipments));
            $manager->persist($classroom);
        }

        for ($i = 0; $i < 5; $i++) {
            $booking = new Booking();
            $booking->setClient($client)
                ->setNumber('Booking-' . $i)
                ->setClassroom($classroom)
                ->setStartDate($faker->dateTimeThisMonth)
                ->setEndDate($faker->dateTimeThisYear('+5 months'))
                ->setAmount($faker->randomFloat(2, 30000, 5000000))
                ->setStatus($faker->boolean)
                ->addCustomer($customer)
                ->setCreatedAt($faker->dateTimeThisYear)
                ->setUpdatedAt($faker->dateTimeThisYear);
            $manager->persist($booking);
        }

        // Flush
        $manager->flush();
    
    } 

}

