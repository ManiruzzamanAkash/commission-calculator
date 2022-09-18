<?php

declare(strict_types=1);

include __DIR__ . '/vendor/autoload.php';

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'no_alternative_syntax' => true,
        'strict_comparison' => true,
        'strict_param' => true,
        'declare_strict_types' => true,
        'yoda_style' => false,
    ])
    ->setFinder(
        (new PhpCsFixer\Finder())->in('src')
    )
    ->setUsingCache(false)
    ->setRiskyAllowed(true);
