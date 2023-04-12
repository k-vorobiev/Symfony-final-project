<?php

namespace App\Form;

use App\Entity\Feedback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FeedbackFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('body', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Ваш комментарий'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите текст отзыва'
                    ])
                ]
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Ваше Имя'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Имя не может быть пустым'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Ваш Email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Email не может быть пустым'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
