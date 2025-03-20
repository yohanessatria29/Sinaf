<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

function encrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */        
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv â€“ encrypt method AES-256-CBC expects 16 bytes â€“ else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}

function encrypt_data($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_keys"];
    $secret_iv      = 2019;
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv â encrypt method AES-256-CBC expects 16 bytes â else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}

function decrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv â€“ encrypt method AES-256-CBC expects 16 bytes â€“ else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);

    //do the decryption given text/string/number

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function decrypt_data($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_keys"];
    $secret_iv      = 2019;
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv â encrypt method AES-256-CBC expects 16 bytes â else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);

    //do the decryption given text/string/number

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}

function decrypt_data_v3($string){
    $CI =& get_instance();
    //$string = 'NyB2X6BAG74880x8tsawWr4ZVh4jQOIqH/RHDp2bXDI=';
    
    /*$sql = "select `key` from covid.t_key order by id DESC limit 1";
    $query = $CI->db->query($sql);
    foreach ($query->result_array() as $k) {
        $secret_key = $k['key'];
    }*/
    
    $secret_key = get_keyKMS();
    
    $data = json_encode([
       'data' => $string,
       'kunci' => $secret_key
    ]);
    //print_r($data);
    //$jsondata = json_encode($data);
    //$url = '202.70.136.86:3000/api/v1/decryptdb';
    $url = '192.168.49.25:3000/api/v1/decryptdb';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL , $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    //print_r($response);
    
    curl_close($ch);
    //echo $response;

    $json = json_decode($response, true);
    return $datajson = $json['result'];

}

function encrypt_data_v3($string){
    $CI =& get_instance();
    //$string = 'NyB2X6BAG74880x8tsawWr4ZVh4jQOIqH/RHDp2bXDI=';
    
    /*$sql = "select `key` from covid.t_key order by id DESC limit 1";
    $query = $CI->db->query($sql);
    foreach ($query->result_array() as $k) {
        $secret_key = $k['key'];
    }*/
    
    $secret_key = get_keyKMS();
    
    $data = json_encode([
       'data' => $string,
       'kunci' => $secret_key
    ]);
    //print_r($data);
    //$jsondata = json_encode($data);
    //$url = '202.70.136.86:3000/api/v1/encryptdb';
    
    $url = '192.168.49.25:3000/api/v1/encryptdb';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL , $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    //print_r($response);
    
    curl_close($ch);
    //echo $response;

    $json = json_decode($response, true);
    return $datajson = $json['result'];

}

function get_keyKMS(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => '192.168.52.15:8080/api/v1/secret/rsonline',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "labelsecret" : "db_rsonline"
    }',
      CURLOPT_HTTPHEADER => array(
        'X-Kms-Token: 84tMxLFWYOUJ#MFEdlVdKqmIFuKZrxVl',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $json = json_decode($response, true);
    return $datajson = $json['result'];
}
