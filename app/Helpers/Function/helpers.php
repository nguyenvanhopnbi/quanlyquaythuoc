<?php

/*
 * Helper for function
 */


if (!function_exists('show_to_view')) {
    /**
     * @param $value
     * @param $defualt
     * @return mixed
     */
    function show_to_view($value,$default=null){
        return isset($value)?$value:$default;
    }
}

