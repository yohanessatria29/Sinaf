<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mlogin extends CI_Model
{

    function query_validasi_email($email)
    {
        $result = $this->db->get_where('users', array('email' => $email), 1);
        return $result;
    }

    function query_validasi_password($email, $hashed)
    {
        $result = $this->db->get_where('users', array('email' => $email, 'password_enkripsi' => $hashed), 1);
        return $result;
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function input_data($table, $data)
    {
        $this->db->insert($table, $data);
    }


    public function insert_log($user_id, $status = 'SUCCESS')
    {
        $ip         = $this->input->ip_address();
        $user_agent = $this->input->user_agent();
        $location   = $this->get_location_by_ip($ip);

        $data = [
            'users_id'     => $user_id,
            // 'login_time'  => date('Y-m-d H:i:s'),
            'ip_address'  => $ip,
            'user_agent'  => $user_agent,
            'status'      => $status,
            'location'    => $location
        ];

        $insert = $this->db->insert('user_log_login', $data);

        if ($insert) {
            return $this->db->insert_id();
        } else {
            log_message('error', 'Insert login log failed: ' . $this->db->_error_message());
            return false;
        }
    }

    public function update_logout_time($log_id)
    {
        $this->db->set('logout_time', 'NOW()', false);
        $this->db->where('id', $log_id);
        $update = $this->db->update('user_log_login');

        if (!$update) {
            log_message('error', 'Logout update failed: ' . $this->db->_error_message());
        }

        return $update;
    }

    private function get_location_by_ip($ip)
    {
        $url = "http://ip-api.com/json/{$ip}?fields=country,regionName,city,status";
        $response = @file_get_contents($url);

        if ($response !== FALSE) {
            $data = json_decode($response, true);
            if (isset($data['status']) && $data['status'] === 'success') {
                return $data['city'] . ', ' . $data['regionName'] . ', ' . $data['country'];
            }
        }

        return null;
    }
}
