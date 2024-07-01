<?php

namespace App\DataFixtures;

use App\Entity\Source;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SourceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $sources = [
            ['project_id' => 1, 'nom' => 'Source 1', 'description' => 'Description of source 1'],
            ['project_id' => 2, 'nom' => 'Source 2', 'description' => 'Description of source 2'],
            ['project_id' => 3, 'nom' => 'Source 3', 'description' => 'Description of source 3'],
            ['project_id' => 4, 'nom' => 'Source 4', 'description' => 'Description of source 4'],
            ['project_id' => 5, 'nom' => 'Source 5', 'description' => 'Description of source 5'],
            ['project_id' => 6, 'nom' => 'Source 6', 'description' => 'Description of source 6'],
            ['project_id' => 7, 'nom' => 'Source 7', 'description' => 'Description of source 7'],
            ['project_id' => 8, 'nom' => 'Source 8', 'description' => 'Description of source 8'],
            ['project_id' => 9, 'nom' => 'Source 9', 'description' => 'Description of source 9'],
            ['project_id' => 10, 'nom' => 'Source 10', 'description' => 'Description of source 10'],
        ];

        foreach ($sources as $index => $sourceData) {
            $source = new Source();
            $project = $this->getReference('project_' . $sourceData['project_id']);
            $source->setProject($project);
            $source->setNom($sourceData['nom']);
            $source->setDescription($sourceData['description']);

            $manager->persist($source);
            // Ajouter une référence pour cette source
            $this->addReference('source_' . ($index + 1), $source);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixtures::class,
        ];
    }
}
