<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\User;
use App\Entity\UserLanguage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserLanguageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $userLanguageData = [
            ['user' => 1, 'language' => 1, 'level' => 'Advanced', 'description' => 'Fluent in both written and spoken'],
            ['user' => 2, 'language' => 2, 'level' => 'Intermediate', 'description' => 'Fluent in both written and spoken'],
            ['user' => 3, 'language' => 3, 'level' => 'Beginner', 'description' => 'Fluent in both written and spoken'],
            ['user' => 4, 'language' => 4, 'level' => 'Advanced', 'description' => 'Fluent in both written and spoken'],
            ['user' => 5, 'language' => 5, 'level' => 'Intermediate', 'description' => 'Fluent in both written and spoken'],
            ['user' => 6, 'language' => 6, 'level' => 'Beginner', 'description' => 'Fluent in both written and spoken'],
            ['user' => 7, 'language' => 7, 'level' => 'Advanced', 'description' => 'Fluent in both written and spoken'],
            ['user' => 8, 'language' => 8, 'level' => 'Intermediate', 'description' => 'Fluent in both written and spoken'],
            ['user' => 9, 'language' => 9, 'level' => 'Beginner', 'description' => 'Fluent in both written and spoken'],
            ['user' => 10, 'language' => 10, 'level' => 'Advanced', 'description' => 'Fluent in both written and spoken'],
        ];

        foreach ($userLanguageData as $data) {
            // Récupérez l'utilisateur à partir de la référence créée dans UserFixtures
            $userReference = 'user_' . $data['user'];
            $user = $this->getReference($userReference);
            
            // Récupérez la langue à partir de la référence créée dans LanguageFixtures
            $languageReference = 'language_' . $data['language'];
            $language = $this->getReference($languageReference);
    
            $userLanguage = new UserLanguage();
            $userLanguage->setUser($user);
            $userLanguage->setLanguage($language);
            $userLanguage->setLevel($data['level']);
            $userLanguage->setDescription($data['description']);
            $manager->persist($userLanguage);
        }
    
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            LanguageFixtures::class,
        ];
    }
}
