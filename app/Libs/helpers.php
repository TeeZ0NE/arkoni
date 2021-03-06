<?php

//Output a limited number of words
if (!function_exists('do_excerpt')) {
    function do_excerpt($string, $word_limit)
    {
        $words = explode(' ', strip_tags($string), ($word_limit + 1));
        if (count($words) > $word_limit)
            array_pop($words);
        return implode(' ', $words) . ' ...';
    }
}

if (!function_exists('print_array')) {
    function print_array($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}