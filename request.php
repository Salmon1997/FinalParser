<?php
header('Content-Type: application/json');

include('simple_html_dom.php');
include('functions.php');

$_POST = json_decode(file_get_contents("php://input"), true);

if (isset($_POST['url']) && !empty($_POST['url'])) {
  $response = file_get_html($_POST['url']);
  $result = getComponents($response);
  echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
  exit;
}

echo json_encode('Введите адрес заново', JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
