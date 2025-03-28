<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude([
        'bin',
        'var',
        'vendor',
    ]);

$ruleSet = new \App\PhpCsFixer\SymfonyRuleSet();

$config = (new PhpCsFixer\Config())
    ->setRules($ruleSet->getRules())
    ->setIndent('    ')
    ->setLineEnding("\n")
    ->setUsingCache(true)
    ->setCacheFile("var/cache/.php-cs-fixer.cache")
    ->setFinder($finder);

return $config;
