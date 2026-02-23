<?php

namespace App\DataFixtures;

use App\Factory\AutorFactory;
use App\Factory\EditorialFactory;
use App\Factory\LibroFactory;
use App\Factory\SocioFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        AutorFactory::createMany(200);
        SocioFactory::createMany(20);
        EditorialFactory::createMany(100);
        LibroFactory::createMany(50, function () {
            $faker = Factory::create();
            return [
                "autores" => AutorFactory::randomRange(1,3),
                "socioPrestado" => $faker->boolean(25) ? SocioFactory::random() : null,
                "editorial" => EditorialFactory::random()
            ];
        });



        $manager->flush();
    }
}
