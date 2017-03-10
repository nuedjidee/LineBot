<?php
$access_token = 'JvXW9ZR3h2C1gw0iS00s4T7tgphrcfqnye6wAln1Yh/RWEsE+2G6VQt+DKvhQtRW+lp/c8r+QHSeOxHZSAbOMvLKGog0msjNu4pzlTS4ILjeZDT3hN7ZZcWQ0zTHl/Sq7gUNzr08Vg+0r+GxtUOgggdB04t89/1O/w1cDnyilFU=';
$proxy = 'http://fixie:PB77FHxUYoYivES@velodrome.usefixie.com:80';
$proxyauth = 'nu.ed@hotmail.com:wy*8ghhe';
$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);

$result = curl_exec($ch);
curl_close($ch);

echo $result;
