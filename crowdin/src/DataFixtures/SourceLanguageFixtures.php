<?php

namespace App\DataFixtures;

use App\Entity\LanguageCible;
use App\Entity\LanguageOrigin;
use App\Entity\Source;
use App\Entity\SourceLanguage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SourceLanguageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $sourceLanguageData = [
            ['source' => 'source_1', 'language_cible' => 'language_cible_1', 'language_origin' => 'language_origin_2'],
            ['source' => 'source_2', 'language_cible' => 'language_cible_2', 'language_origin' => 'language_origin_3'],
            ['source' => 'source_3', 'language_cible' => 'language_cible_3', 'language_origin' => 'language_origin_4'],
            ['source' => 'source_4', 'language_cible' => 'language_cible_4', 'language_origin' => 'language_origin_5'],
            ['source' => 'source_5', 'language_cible' => 'language_cible_5', 'language_origin' => 'language_origin_6'],
            ['source' => 'source_6', 'language_cible' => 'language_cible_6', 'language_origin' => 'language_origin_7'],
            ['source' => 'source_7', 'language_cible' => 'language_cible_7', 'language_origin' => 'language_origin_8'],
            ['source' => 'source_8', 'language_cible' => 'language_cible_8', 'language_origin' => 'language_origin_9'],
            ['source' => 'source_9', 'language_cible' => 'language_cible_9', 'language_origin' => 'language_origin_10'],
            ['source' => 'source_10', 'language_cible' => 'language_cible_10', 'language_origin' => 'language_origin_1'],
        ];

        foreach ($sourceLanguageData as $data) {
            $source = $this->getReference($data['source']);
            $languageCible = $this->getReference($data['language_cible']);
            $languageOrigin = $this->getReference($data['language_origin']);

            $sourceLanguage = new SourceLanguage();
            $sourceLanguage->setSource($source);
            $sourceLanguage->setLanguageCible($languageCible);
            $sourceLanguage->setLanguageOrigin($languageOrigin);

            $manager->persist($sourceLanguage);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SourceFixtures::class,
            LanguageCibleFixtures::class,
            LanguageOriginFixtures::class,
        ];
    }
}
