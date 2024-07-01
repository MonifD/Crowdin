<?php
namespace App\Form;

use App\Entity\UserLanguage;
use App\Entity\Language;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserLanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('language', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'langue',
            ])
            ->add('level', ChoiceType::class, [
                'choices' => [
                    'Basic' => 'Basic',
                    'Intermediate' => 'Intermediate',
                    'Advanced' => 'Advanced',
                    'Fluent' => 'Fluent',
                ],
                'label' => 'Level',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserLanguage::class,
        ]);
    }
}
