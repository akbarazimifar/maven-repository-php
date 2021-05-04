<?php

if (! function_exists("join_string")) {
    function join_string(...$args) {
        $args = array_filter($args, function($x) {
            return ! empty(trim($x));
        });

        return implode("/", $args);
    }
}
