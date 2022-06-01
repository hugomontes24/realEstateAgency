<?php

namespace App\DataFixtures;

use \Faker\Factory;
use App\Entity\User;
use Faker\Generator;
// use Generator;
use App\Entity\Contact;
use PhpParser\Node\Expr\New_;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
        $users = [];
        $admin = new User();
        $admin->setUsername('admin')
            ->setRoles(['ROLE_USER, ROLE_ADMIN'])
            ->setPlainPassword('admin');

        $users[] = $admin;
        $manager->persist($admin);

        for($i = 0; $i<5; $i++){
            $user = new User();

        //     // $hashPassword = $this->hasher->hashPassword(
        //     //     $user,
        //     //     'password'
        //     // );


            $user->setUsername($this->faker->name())
            // $user->setUsername('demo')

                ->setPlainPassword('demo')
                ->setRoles(['ROLE_USER']);

            $manager->persist($user);
        }
    
    

        // Contact
        // for ($i=0; $i < 5 ; $i++) { 
        //     $contact = new Contact;
        //     $date = $contact->getCreatedAt()->format('d-m-Y');
        //     $contact
        //         ->setUsername($this->faker->name())
        //         ->setSubject('Demande n° '. ($i+1))
        //         ->setMessage($this->faker->text())
        //     ;
    //     }

        $manager->flush();
    }


}
