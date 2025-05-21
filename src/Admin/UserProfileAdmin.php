<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserProfileAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('fullName', TextType::class, [
                'label' => 'ФИО',
                'required' => false,
            ])
            ->add('birthday', DateType::class, [
                'label' => 'День рождения',
                'widget' => 'single_text',
                'required' => false,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('fullName');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('fullName', null, ['label' => 'ФИО'])
            ->add('birthday', null, ['label' => 'День рождения']);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('fullName', null, ['label' => 'ФИО'])
            ->add('birthday', null, ['label' => 'День рождения']);
    }
}
