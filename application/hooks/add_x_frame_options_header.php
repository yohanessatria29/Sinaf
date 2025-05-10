<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function add_x_frame_options_header()
{
    $CI = &get_instance();
    $CI->output->set_header('X-Frame-Options: SAMEORIGIN');
}


// Function to set Content Security Policy Header
function add_csp_header()
{
    $CI = &get_instance();
    $CI->output->set_header('Content-Security-Policy: default-src \'self\'; script-src \'self\' https://apis.google.com; style-src \'self\' https://fonts.googleapis.com; font-src \'self\' https://fonts.gstatic.com;');
}
