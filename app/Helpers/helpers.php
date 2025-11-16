<?php

if (! function_exists('enum_values')) {
    function enum_values(string $enumClass): array
    {
        if (! enum_exists($enumClass)) {
            return [];
        }

        return array_column($enumClass::cases(), 'value');
    }
}

if (! function_exists('enum_labels')) {
    function enum_labels(string $enumClass): array
    {
        if (! enum_exists($enumClass)) {
            info('enum not found');

            return [];
        }

        $options = [];
        foreach ($enumClass::cases() as $case) {
            $options[$case->value] = str($case->name)->headline();
        }

        return $options;
    }
}
