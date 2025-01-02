<?php

declare(strict_types=1);

namespace App\Invoice\Form\Type;

use App\Invoice\Entity\CustomerDetails;
use App\Invoice\Enum\Currency;
use App\Invoice\Enum\PaymentMethod;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;

class InvoiceFormType extends AbstractType
{
    public function __construct()
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): FormInterface
    {
        return $builder
            ->add('supplier', EntityType::class, [
                'class' => CustomerDetails::class,
                'choice_label' => 'fullName',
                'placeholder' => 'Choose an option',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('customer', EntityType::class, [
                'class' => CustomerDetails::class,
                'choice_label' => 'fullName',
                'placeholder' => 'Choose an option',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('issuedAt', DateType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dueAt', DateType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('taxableSupplyAt', DateType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('paymentMethod', EnumType::class, [
                'class' => PaymentMethod::class,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('currency', EnumType::class, [
                'class' => Currency::class,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary save'],
            ])
            ->getForm();
    }
}
