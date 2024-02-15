<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => "Prénom"
            ])
            ->add('lastname', TextType::class, [
                'label' => "Nom"
            ])
            ->add('email', EmailType::class, [
                'label' => "Adresse E-mail"
            ])
            // ->add('password', PasswordType::class) 
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'constraints' => new NotBlank([
                        'message' => 'Le mot de passe ne doit pas être vide.',
                    ]),
                ],

                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'constraints' => new NotBlank([
                        'message' => 'La confirmation du mot de passe ne doit pas être vide.',
                    ]),
                ],
                
                'invalid_message' => 'Les mots de passe ne sont pas identiques',
                
            ] ) 
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => "Je suis d'accord avec les termes et conditions",
                'required' => true
            ])

            ->add('submit', SubmitType::class, [
                'label' => "S'enregistrer"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
