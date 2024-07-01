<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\LanguageCible;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageCibleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $languages = $manager->getRepository(Language::class)->findAll();

        foreach ($languages as $index => $language) {
            $languageCible = new LanguageCible();
            $languageCible->setLanguage($language);

            $manager->persist($languageCible);
            // Ajouter une référence pour ce LanguageCible
            $this->addReference('language_cible_' . ($index + 1), $languageCible);
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
