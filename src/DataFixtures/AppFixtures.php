<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
// use Generator;
use PhpParser\Node\Expr\New_;
use \Faker\Factory;
use Faker\Generator;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    /**
     * @var Generator
     */
    private Generator $faker;

    // /**
    //  * Undocumented variable
    //  *
    //  * @var UserPasswordHasherInterface
    //  */
    // private UserPasswordHasherInterface $hasher;

    public function __construct()
    {
        $this->faker = Factory::create("fr_FR");   
        // $this->hasher = $hasher; 
    }

    /**
     * Undocumented function
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        //Users
        for($i = 0; $i<1; $i++){
            $user = new User();

            // $hashPassword = $this->hasher->hashPassword(
            //     $user,
            //     'password'
            // );

            // $user->setUsername($this->faker->name())
            $user->setUsername('demo')

                ->setPlainPassword('demo')
                ->setRoles(['ROLE_ADMIN']);

            $manager->persist($user);
        }

        $manager->flush();
    }


}
