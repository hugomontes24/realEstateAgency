<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '255'
                ],
                'label' => 'username',
                'label_attr' => [
                    'class'=>'form-label'
                ],
                'constraints' => [
                    new Assert\NotBlank(), 
                    new Assert\Length([
                        'min'=> 2, 
                        'max'=> 255
                        ])
                    ]
                ])
                ->add('plainPassword', 
                    PasswordType::class, 
                    [
                        'attr' => ['class' => 'form-control'],
                        'label' => 'Mot de passe',
                        'label_attr' => ['class' => 'form-label']
                    ]
                )
            ->add('submit', 
                SubmitType::class, 
                [
                    'attr' => ['class' => 'btn btn-primary mt-4']
                ]
            )
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}