<?php

namespace App\Form;

use App\Entity\Employes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 15,
                        'minMessage' => 'Le nom doit avoir au moin 2 caractere',
                        'maxMessage' => 'Le nom doit pas deppasser 15 caractere'
                    ]),
                    new NotBlank(['message' => 'Vous devez ecrit le nom'])
                ],
                "attr" => [
                    'class' => 'form-control'
                ]

            ])
            ->add('firstname', null, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 15,
                        'minMessage' => 'Le prenom doit avoir au moin 2 caractere',
                        'maxMessage' => 'Le prenom doit pas deppasser 15 caractere'
                    ]),
                    new NotBlank(['message' => 'Vous devez ecrit le prenom'])
                ]
            ])
            ->add('salary', null, [
                'constraints' => [
                    new LessThan(6000),
                    new GreaterThan(1000),
                    new NotBlank(['message' => 'Vous devez ecrit le salaire'])
                ]
            ])

            ->add('departement', null, [
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 15,
                        'minMessage' => 'Le departement doit avoir au moin 2 caractere',
                        'maxMessage' => 'Le departement doit pas deppasser 15 caractere'
                    ]),
                    new NotBlank(['message' => 'Vous devez ecrit le departement'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employes::class,
        ]);
    }
}
