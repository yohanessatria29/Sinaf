<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function add_x_frame_options_header()
{
    $CI = &get_instance();
    $CI->output->set_header('X-Frame-Options: SAMEORIGIN');
}
