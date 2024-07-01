<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\User;
use App\Form\AddSourceProjectType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('contenu')
            ->add('sources', CollectionType::class, [
                'entry_type' => AddSourceProjectType::class, // Assuming you have a SourceType form
                'entry_options' => ['label' => false], // If you want to customize the options for each source
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false, // Set to false to force copying of object instead of passing by reference
                'label' => false, // Hide the label for the CollectionType field
            ])
            ->add('save', SubmitType::class,[
                'label'=>"Enregistrer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
