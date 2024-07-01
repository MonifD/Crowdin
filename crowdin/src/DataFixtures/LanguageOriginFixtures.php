<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\LanguageOrigin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageOriginFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $languages = $manager->getRepository(Language::class)->findAll();

        foreach ($languages as $index => $language) {
            $languageOrigin = new LanguageOrigin();
            $languageOrigin->setLanguage($language);

            $manager->persist($languageOrigin);
            // Ajouter une référence pour ce LanguageOrigin
            $this->addReference('language_origin_' . ($index + 1), $languageOrigin);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LanguageFixtures::class,
        ];
    }
}
