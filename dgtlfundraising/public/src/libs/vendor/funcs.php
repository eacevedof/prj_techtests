<?php
function get_post_v($key){
    $keys = array_keys($_POST);
    if(in_array($key,$keys)) return $_POST[$key];
    return "";
}

function is_post_k($key){
    $keys = array_keys($_POST);
    return in_array($key,$keys);
}