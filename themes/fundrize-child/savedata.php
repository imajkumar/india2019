<?php


$whitelistData = array(
    '127.0.0.1',
    '::1'
);
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelistData)){


}
$user_ip = '59.97.79.19';
$access_url = "http://api.ipstack.com/";        
$iptkey='ef7ff697fcf23bceca167c80b762a0be';
$access_key = "?access_key=".$iptkey;            
$ip_data = json_decode(file_get_contents($access_url . $user_ip . $access_key), true);            
$userip=$ip_data['ip'];
echo '<pre>';print_r($ip_data);echo '</pre>';

?>