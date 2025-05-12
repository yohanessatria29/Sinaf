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
    // $CI = &get_instance();

    // // Define the Content-Security-Policy header
    // $csp = "default-src 'self'; 
    //         script-src 'self' https://apis.google.com https://cdn.datatables.net https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js https://code.jquery.com https://cdnjs.cloudflare.com; 
    //         style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com; 
    //         font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; 
    //         img-src 'self' data:; 
    //         connect-src 'self'; 
    //         frame-src 'self';";

    // // Set the header
    // $CI->output->set_header('Content-Security-Policy: ' . $csp);


    $nonce = base64_encode(random_bytes(16)); // Menghasilkan nonce yang aman

    // Menyimpan nonce ke session agar bisa digunakan di view
    $CI = &get_instance();
    $CI->session->set_userdata('nonce', $nonce);


    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-eval' 'unsafe-inline' https://cdn.datatables.net https://code.jquery.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net https://ajax.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; connect-src 'self'; frame-src 'self';");
}


function remove_headers()
{
    header_remove('X-Powered-By');
    header_remove('Server');
}
