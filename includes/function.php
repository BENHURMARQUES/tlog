<?php

function remove($string)
{
    $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',           // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',   // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@');      // Strip multi-line comments including CDATA
    $string = preg_replace($search, '', $string);
    $string = trim($string);                           //limpa espaos vazio
    $string = strip_tags($string);                     //tira tags html e php
    $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    return $string;
}
function removeDeep($value)
{
    if (is_array($value)) {
        $value = array_map("removeDeep", $value);
    } else if (is_int($value)) {
        $value = (int)remove($value);
    } else {
        $value = remove($value);
    }
    return $value;
}