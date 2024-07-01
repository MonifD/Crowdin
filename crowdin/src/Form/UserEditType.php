<?php
namespace App\Form;

use App\Entity\User;
use App\Entity\Language;
use App\Entity\UserLanguage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name')
            ->add('last_name')
            ->add('username')
            ->add('email')
            ->add('is_trad', CheckboxType::class, [
                'label' => 'Is Trad',
                'required' => false,
                'data' => false,
            ])

            ->add('languages', EntityType::class, [
                'class' => Language::class,
                'choice_label' => 'langue',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Languages',
                'required' => false,
                'attr' => [
                    'class' => 'form-select', // Optional: Bootstrap class for styling
                ],
            ])
            ->add('save', SubmitType::class,[
                'label'=>"Enregistrer"
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}