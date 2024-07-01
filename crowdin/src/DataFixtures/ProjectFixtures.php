<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $projectsData = [
            ['name' => 'Project 1', 'user_id' => 1, 'contenu' => 'Content of project 1'],
            ['name' => 'Project 2', 'user_id' => 2, 'contenu' => 'Content of project 2'],
            ['name' => 'Project 3', 'user_id' => 3, 'contenu' => 'Content of project 3'],
            ['name' => 'Project 4', 'user_id' => 4, 'contenu' => 'Content of project 4'],
            ['name' => 'Project 5', 'user_id' => 5, 'contenu' => 'Content of project 5'],
            ['name' => 'Project 6', 'user_id' => 6, 'contenu' => 'Content of project 6'],
            ['name' => 'Project 7', 'user_id' => 7, 'contenu' => 'Content of project 7'],
            ['name' => 'Project 8', 'user_id' => 8, 'contenu' => 'Content of project 8'],
            ['name' => 'Project 9', 'user_id' => 9, 'contenu' => 'Content of project 9'],
            ['name' => 'Project 10', 'user_id' => 10, 'contenu' => 'Content of project 10'],
        ];

        foreach ($projectsData as $index => $projectData) {
            $project = new Project();
            $project->setName($projectData['name']);
            
            // Utilisation de la référence au lieu de find()
            $user = $this->getReference('user_' . $projectData['user_id']);
            $project->setUser($user);

            $project->setContenu($projectData['contenu']);

            $manager->persist($project);
            // Ajouter une référence pour ce projet
            $this->addReference('project_' . ($index + 1), $project);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
