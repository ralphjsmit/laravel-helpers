<?php

return [
    'laravel' => [
        /**
         * This value determines whether the Domain\\ namespace is taken into account when
         * guessing the factory names.
         *
         * When set to false, 'Domain\Blog\Models\User' will resolve to 'Database\Factories\Blog\UserFactory'.
         * When set to true, 'Domain\Blog\Models\User' will resolve to 'Database\Factories\Domain\Blog\UserFactory'.
         *
         * Only relevant for a DDD project.
         */
        'guess_factory_names_with_domain_namespace' => false,

        /**
         * This value determines whether the Support\\ namespace is taken into account when
         * guessing the factory names.
         *
         * When set to false, 'Support\Blog\Models\User' will resolve to 'Database\Factories\Blog\UserFactory'.
         * When set to true, 'Support\Blog\Models\User' will resolve to 'Database\Factories\Support\Blog\UserFactory'.
         *
         * Only relevant for a DDD project.
         */
        'guess_factory_names_with_support_namespace' => true,

        /*
         * This value determines whether factory names are guessed on basis of a package namespace.
         *
         * When set to false, 'RalphJSmit\Filament\CMS\Blog\Models\Page' will resolve to 'Database\Factories\RalphJSmit\Filament\CMS\Blog\PageFactory'
         * When set to true, 'RalphJSmit\\Filament\\CMS\\Blog\\Models\\Page' will resolve to 'RalphJSmit\\Filament\\CMS\\Database\\Factories\\Blog\\PageFactory'
         *
         */
        'guess_factory_names_with_package_namespace' => false,
    ],
];
