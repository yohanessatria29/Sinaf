<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('sanitize_input')) {
    function sanitize_input($input)
    {
        if (is_array($input)) {
            return array_map('sanitize_input', $input);
        }
        return str_replace(["'", '"', ';'], '', $input);
    }
}
