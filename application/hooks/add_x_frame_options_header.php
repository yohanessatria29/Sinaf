if (!defined('BASEPATH')) exit('No direct script access allowed');

function add_x_frame_options_header() {
// Get the CodeIgniter instance
$CI =& get_instance();
// Set the X-Frame-Options header
$CI->output->set_header('X-Frame-Options: SAMEORIGIN');
}