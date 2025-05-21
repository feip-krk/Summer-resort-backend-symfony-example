<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Address;
use App\Entity\Contact;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class ShopAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title')
            ->add('address', EntityType::class, [
                'class' => Address::class,
                'choice_label' => 'street',
                'placeholder' => 'Выберите адрес',
                //                'associated_property' => 'street',
                'required' => false,
            ])
            ->add('contacts', EntityType::class, [
                'class' => Contact::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => false,
                'required' => false,
            ])
            ->add('latitude', NumberType::class, [
                'scale' => 8,
                'html5' => true,
                'required' => true,
                'attr' => [
                    'min' => -90,
                    'max' => 90,
                    'placeholder' => 'Например: 55.755825',
                ],
                'help' => 'Введите широту в формате 55.755825 (до 8 знаков после точки)',
            ])
            ->add('longitude', NumberType::class, [
                'scale' => 8,
                'html5' => true,
                'required' => true,
                'attr' => [
                    'min' => -180,
                    'max' => 180,
                    'step' => '0.00000001',
                    'placeholder' => 'Например: 37.617298',
                ],
                'help' => 'Введите долготу в формате 37.617298 (диапазон от -180 до 180, до 8 знаков после точки)',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'required' => false,
                'attr' => [
                    'rows' => 8,
                    'class' => 'sonata-textarea-autosize',
                ],
                'empty_data' => '', // значение по умолчанию
                'trim' => true, // автоматически обрезать пробелы
            ])
            ->add('seo.metaTitle', null, [
                'label' => 'Meta Title',
                'required' => false,
            ])
            ->add('seo.metaDescription', null, [
                'label' => 'Meta Description',
                'required' => false,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('title');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('title');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('title')
            ->add('address', null, [
                'label' => 'Адрес',
                'associated_property' => 'street',
            ])
            ->add('description', null, [
                'label' => 'Описание',
            ])
            ->add('contacts', null, [
                'label' => 'Контакты',
                'associated_property' => 'title',
            ])
            ->add('seo.metaTitle', null, [
                'label' => 'Meta Title',
            ])
            ->add('seo.metaDescription', null, [
                'label' => 'Meta Description',
            ]);
    }
}
