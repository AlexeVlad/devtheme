<?php 
function pr($var = '') {
    echo '<pre style="background:pink; border: red solid 1px; padding: 5px">';
    print_r($var);
    echo '</pre>';
}

function vd($var = '') {
    echo '<pre style="background:pink; border: red solid 1px; padding: 5px">';
    var_dump($var);
    echo '</pre>';
}

