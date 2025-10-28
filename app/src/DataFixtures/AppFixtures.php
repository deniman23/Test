<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = [];
        $categoryNames = ['Fiction', 'Science', 'History', 'Fantasy', 'Biography'];

        foreach ($categoryNames as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i = 0; $i < 100; $i++) {
            $book = new Book();
            $book
                ->setTitle($faker->sentence(3))
                ->setAuthor($faker->name)
                ->setPublishedAt($faker->dateTimeBetween('-30 years', 'now'))
                ->setDescription($faker->paragraphs(asText: true))
                ->setIsbn($faker->isbn13)
                ->setCategory($faker->randomElement($categories))
            ;
            $manager->persist($book);
        }

        $manager->flush();
    }
}
