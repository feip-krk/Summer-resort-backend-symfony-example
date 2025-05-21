<?php

declare(strict_types=1);

use DAMA\DoctrineTestBundle\DAMADoctrineTestBundle;
use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Nelmio\ApiDocBundle\NelmioApiDocBundle;
use Sonata\AdminBundle\SonataAdminBundle;
use Sonata\BlockBundle\SonataBlockBundle;
use Sonata\Doctrine\Bridge\Symfony\SonataDoctrineBundle;
use Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle;
use Sonata\Exporter\Bridge\Symfony\SonataExporterBundle;
use Sonata\Form\Bridge\Symfony\SonataFormBundle;
use Sonata\Twig\Bridge\Symfony\SonataTwigBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MakerBundle\MakerBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\UX\StimulusBundle\StimulusBundle;
use Twig\Extra\TwigExtraBundle\TwigExtraBundle;

return [
    FrameworkBundle::class => ['all' => true],
    MonologBundle::class => ['all' => true],
    SecurityBundle::class => ['all' => true],
    DoctrineBundle::class => ['all' => true],
    DoctrineMigrationsBundle::class => ['all' => true],
    DebugBundle::class => ['dev' => true],
    TwigBundle::class => ['all' => true],
    WebProfilerBundle::class => ['dev' => true, 'test' => true],
    MakerBundle::class => ['dev' => true],
    DAMADoctrineTestBundle::class => ['test' => true],
    DoctrineFixturesBundle::class => ['dev' => true, 'test' => true],
    NelmioApiDocBundle::class => ['all' => true],
    TwigExtraBundle::class => ['dev' => true, 'test' => true],
    StimulusBundle::class => ['all' => true],
    SonataTwigBundle::class => ['all' => true],
    SonataFormBundle::class => ['all' => true],
    SonataExporterBundle::class => ['all' => true],
    SonataDoctrineBundle::class => ['all' => true],
    SonataBlockBundle::class => ['all' => true],
    KnpMenuBundle::class => ['all' => true],
    SonataAdminBundle::class => ['all' => true],
    SonataDoctrineORMAdminBundle::class => ['all' => true],
];
