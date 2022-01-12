<?php

return [
    'laravel' => [
        /**
         * This function determines whether the Domain\\ namespace is taken into account when
         * guessing the factory names.
         *
         * When set to false, 'Domain\Blog\Models\User' will resolve to 'Database\Factories\Blog\UserFactory'.
         * When set to true, 'Domain\Blog\Models\User' will resolve to 'Database\Factories\Domain\Blog\UserFactory'.
         *
         * Only relevant for a DDD project.
         */
        'guess_factory_names_with_domain' => false,
    ],
];
