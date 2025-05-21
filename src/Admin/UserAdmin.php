<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('email', TextType::class)
//            ->add('roles', TextType::class, [
//                'required' => false,
////                'read_only' => true,
//                'help' => 'Через запятую, например: ROLE_USER,ROLE_ADMIN',
//            ])
            ->add('profile', AdminType::class, [
                'label' => 'Профиль пользователя',
                'required' => false,
            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('email');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('email')
            ->add('profile.fullName', null, ['label' => 'ФИО'])
            ->add('profile.birthday', null, ['label' => 'День рождения']);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('email')
            ->add('roles')
            ->add('profile.fullName', null, ['label' => 'ФИО'])
            ->add('profile.birthday', null, ['label' => 'День рождения']);
    }
}
