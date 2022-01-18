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
        'guess_factory_names_with_domain_namespace' => true,

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
    ],
];
