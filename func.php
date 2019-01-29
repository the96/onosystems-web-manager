<?php
$delivery_time_labels = array("指定なし", "9-12時", "12-15時", "15-18時");
$delivered_status_labels = array("未配達", "配達済");
$receivable_status_labels = array("未回答", "受領不可", "受領可能");
function auth() {
  switch (true) {
    case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
    case $_SERVER['PHP_AUTH_USER'] !== 'onosystems':
    case $_SERVER['PHP_AUTH_PW']   !== 'onokouya':
        header('WWW-Authenticate: Basic realm="Enter username and password."');
        header('Content-Type: text/plain; charset=utf-8');
        die('このページを見るにはログインが必要です');
  }

  header('Content-Type: text/html; charset=utf-8');
}

function post($url, $body) {
  $option = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_TIMEOUT => 3,
  ];
  $ch = curl_init($url);
  curl_setopt_array($ch, $option);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $json = curl_exec($ch);
  return json_decode($json, true);
}

function convert($str) {
  return mb_convert_encoding($str, "UTF-8");
}

function get_bool_label($value) {
  if ($result[$str])
    return "true";
  else
    return "false";
}
?>