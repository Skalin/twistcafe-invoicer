<?php

declare(strict_types=1);

namespace App\Invoice\Form\Type;

use App\Invoice\DTO\CustomerDetails\CreateCustomerDetailsDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

/**
 *
 * @method createFormBuilder(CreateCustomerDetailsDTO $model) @see AbstractController::createFormBuilder
 */
class CustomerDetailsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): FormInterface
    {
        return $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('surname', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('phone', TelType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('cinNumber', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('taxNumber', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary save'],
            ])
            ->getForm();
    }
}
