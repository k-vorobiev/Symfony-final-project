<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Ваше имя',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-input' , 'placeholder' => 'Как нам к вам обращаться?'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Имя не может быть пустым',
                    ]),
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Номер телефона',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-input' , 'placeholder' => '+700000000000'],
                'constraints' => [
                    new NotBlank([
                       'message' => 'Номер телефона не может быть пустым',
                    ]),
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'E-mail',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-input', 'placeholder' => 'send@test.ru'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'E-mail не может быть пустым'
                    ]),
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'required' => true,
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => 'Пароль',
                    'label_attr' => ['class' => 'form-label'],
                    'attr' => [
                        'class' => 'form-input',
                        'placeholder' => 'Введите пароль повторно',
                    ],
                ),
                'second_options' => array(
                    'label' => 'Повторите пароль',
                    'label_attr' => ['class' => 'form-label'],
                    'attr' => [
                        'class' => 'form-input',
                        'placeholder' => 'Введите пароль повторно',
                    ],
                ),
                'invalid_message' => 'Поля должны совпадать.',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пожалуйста, введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Пароль не может быть менее {{ limit }} символов',
                        'max' => 4096,
                    ]),
                ],
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
