<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function p($data) {
    if (is_bool($data)) {
        var_dump($data);
    } else if (is_null($data)) {
        var_dump(NULL);
    } else {
        echo '<pre>';
        print_r($data);
    }
}

function xxx() {
    
}
