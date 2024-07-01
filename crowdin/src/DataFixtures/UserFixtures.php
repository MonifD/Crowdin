<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            ['jdoe', 'password1', 'jdoe@example.com', 'John', 'Doe',    true],
            ['jsmith', 'password2', 'jsmith@example.com', 'Jane', 'Smith',    false],
            ['ajohnson', 'password3', 'ajohnson@example.com', 'Alice', 'Johnson',    true],
            ['bbrown', 'password4', 'bbrown@example.com','Bob',  'Brown',    false],
            ['cdavis', 'password5', 'cdavis@example.com','Charlie', 'Davis',    true],
            ['devans', 'password6', 'devans@example.com','Diana', 'Evans',    false],
            ['egreen', 'password7', 'egreen@example.com','Edward', 'Green',    true],
            ['fharris', 'password8', 'fharris@example.com','Fiona', 'Harris',    false],
            ['givory', 'password9', 'givory@example.com','George', 'Ivory',    true],
            ['hjackson', 'password10', 'hjackson@example.com','Hannah', 'Jackson',    false],
        ];

        foreach ($users as $index => $userData) {
            $user = new User();
            $user->setUsername($userData[0]);

            // Hachage du mot de passe
            $hashedPassword = $this->passwordHasher->hashPassword($user, $userData[1]);
            $user->setPassword($hashedPassword);

            $user->setEmail($userData[2]);
            $user->setFirstName($userData[3]);  // Typo à corriger en FirstName
            $user->setLastName($userData[4]);
            
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setUpdateAt(new \DateTimeImmutable());
            $user->setisTrad($userData[5]);

            $manager->persist($user);
            $this->addReference('user_' . ($index + 1), $user);
        }

        $manager->flush();
    }
}
