<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('GetProfileImagePath')) {

    function GetProfileImagePath($var = '') {
        if ($var != "") {
            // return base_url() . "backend/uploads/" . $var;
            return base_url() . "/uploads/" . $var;
        } else {
            return $var;
        }
    }

}
if (!function_exists('DefaultProfileImage')) {

    function DefaultProfileImage() {
        return base_url() . "images/" . 'profile_image.png';
    }

}
if (!function_exists('unhtmlspecialchars')) {

    function unhtmlspecialchars($string) {
        $return_string = '';
        if ($string) {
            $string = str_replace('&amp;', '&', $string);
            $return_string = $string;
        }
        return $return_string;
    }

}