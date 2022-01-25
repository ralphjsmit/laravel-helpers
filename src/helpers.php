<?php

//

if ( ! function_exists('is_enum') ) {
    function is_enum(object $potentialEnum): bool
    {
        return $potentialEnum instanceof StringBackedEnum || $potentialEnum instanceof BackedEnum || $potentialEnum instanceof IntBackedEnum;
    }
}
