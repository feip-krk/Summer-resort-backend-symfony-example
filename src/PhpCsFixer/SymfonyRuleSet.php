<?php

declare(strict_types=1);

namespace App\PhpCsFixer;

class SymfonyRuleSet
{
    public function getRules(): array
    {
        return [
            '@PhpCsFixer' => true,
            // duplicating set of rules for ease of initial formatting
            'blank_line_after_opening_tag' => true,
            'declare_equal_normalize' => true,
            'linebreak_after_opening_tag' => true,
            'return_type_declaration' => ['space_before' => 'none'],
            // end duplicating set of rules
            'cast_spaces' => ['space' => 'none'],
            'empty_loop_body' => ['style' => 'braces'],
            'yoda_style' => [
                'equal' => null,
                'identical' => null,
                'less_and_greater' => null,
            ],
            'nullable_type_declaration_for_default_null_value' => ['use_nullable_type_declaration' => true],
            'ordered_imports' => [
                'sort_algorithm' => 'alpha',
                'imports_order' => ['class', 'function', 'const'],
            ],
            'list_syntax' => ['syntax' => 'short'],
            'concat_space' => ['spacing' => 'one'],
            'ternary_to_null_coalescing' => true,
            'php_unit_internal_class' => ['types' => []],
            'php_unit_test_class_requires_covers' => false,
            'phpdoc_line_span' => [
                'const' => 'single',
                'property' => 'single',
                'method' => 'single',
            ],
            'phpdoc_to_comment' => [
                'ignored_tags' => [
                    'noinspection',
                    'see',
                    'psalm-allow-private-mutation',
                    'psalm-assert',
                    'psalm-assert-if-false',
                    'psalm-assert-if-true',
                    'psalm-consistent-constructor',
                    'psalm-consistent-templates',
                    'psalm-external-mutation-free',
                    'psalm-if-this-is',
                    'psalm-ignore-falsable-return',
                    'psalm-ignore-nullable-return',
                    'psalm-ignore-var',
                    'psalm-immutable',
                    'psalm-import-type',
                    'psalm-internal',
                    'psalm-method',
                    'psalm-mutation-free',
                    'psalm-param',
                    'psalm-param-out',
                    'psalm-property',
                    'psalm-property-read',
                    'psalm-property-write',
                    'psalm-pure',
                    'psalm-readonly',
                    'psalm-readonly-allow-private-mutation',
                    'psalm-require-extends',
                    'psalm-require-implements',
                    'psalm-return',
                    'psalm-seal-properties',
                    'psalm-suppress',
                    'psalm-this-out',
                    'psalm-trace',
                    'psalm-type',
                    'psalm-var',
                ],
            ],
            'phpdoc_summary' => false,
            'phpdoc_types_order' => [
                'null_adjustment' => 'always_last',
                'sort_algorithm' => 'none',
            ],
            'simplified_null_return' => true,
            'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
            'space_after_semicolon' => ['remove_in_empty_for_expressions' => false],
            'blank_line_before_statement' => ['statements' => []],
            'declare_strict_types' => true,
            'global_namespace_import' => [
                'import_classes' => true,
                'import_functions' => true,
            ],
        ];
    }
}
