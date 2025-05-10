<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
    'class'    => '',
    'function' => 'add_x_frame_options_header',
    'filename' => 'add_x_frame_options_header.php',
    'filepath' => 'hooks'
);

$hook['post_controller_constructor'][] = array(
    'function' => 'add_csp_header', // Function to add CSP header
    'filename' => 'add_x_frame_options_header.php', // Hook file created above
    'filepath' => 'hooks'             // Path to hooks directory
);


$hook['post_controller'][] = array(
    'class'    => '',
    'function' => 'remove_headers',
    'filename' => 'add_x_frame_options_header.php',
    'filepath' => 'hooks'
);
