<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $languages = [
            ['Arabic Egyptian', 'AR', 'Afro-Asiatic'],
            ['Arabic Modern', 'AR', 'Afro-Asiatic'],
            ['Chinese', 'ZH', 'Chinese language'],
            ['English', 'EN', 'English language'],
            ['English language', 'EN', 'English language'],
            ['French', 'FR', 'French language'],
            ['German', 'DE', 'German language'],
            ['Italian', 'IT', 'Italian language'],
            ['Japanese', 'JA', 'Japanese language'],
            ['Korean', 'KO', 'Korean language'],
            ['Portuguese', 'PT', 'Portuguese language'],
            ['Russian', 'RU', 'Russian language'],
            ['Spanish', 'ES', 'Spanish language'],
            ['Swahili', 'SW', 'Swahili language'],
            ['Thai', 'TH', 'Thai language'],
            ['Turkish', 'TK', 'Turkish language'],

        ];

        foreach ($languages as $index => $languageData) {
            $language = new Language();
            $language->setLangue($languageData[0]);
            $language->setTag($languageData[1]);
            $language->setDescription($languageData[2]);

            $manager->persist($language);
            $this->addReference('language_' . ($index + 1), $language);
        }

        $manager->flush();
    }
}
