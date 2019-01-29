<?php
require_once '../func.php';
auth();

if (isset($_POST['slip_number']) && 
    isset($_POST['name']) &&
    isset($_POST['address']) &&
    isset($_POST['ship_to']) &&
    isset($_POST['ship_from']) &&
    isset($_POST['time']) &&
    isset($_POST['delivery_time']) &&
    isset($_POST['delivered_status']) &&
    isset($_POST['receivable_status']) &&
    isset($_POST['customer_id']) &&
    isset($_POST['driver_id'])) {
      $input_validity = true;
      $slip_number = convert($_POST['slip_number']); 
      $name = convert($_POST['name']);
      $address = convert($_POST['address']);
      $ship_to = convert($_POST['ship_to']);
      $ship_from = convert($_POST['ship_from']);
      $time = new DateTime(convert($_POST['time']));
      $delivery_time = convert($_POST['delivery_time']);
      $delivered_status = convert($_POST['delivered_status']);
      $receivable_status = convert($_POST['receivable_status']);
      $customer_id = convert($_POST['customer_id']);
      $driver_id = convert($_POST['driver_id']);
      $body = array(
        "slip_number" => $slip_number,
        "name" => $name,
        "address" => $address,
        "ship_to" => $ship_to,
        "ship_from" => $ship_from,
        "time" => $time->format('U'),
        "delivery_time" => $delivery_time,
        "delivered_status" => $delivered_status,
        "receivable_status" => $receivable_status,
        "customer_id" => $customer_id,
        "driver_id" => $driver_id
      );
      $json = json_encode($body, JSON_UNESCAPED_UNICODE);
      $result = post("https://www.onosystems.work/aws/InsertDeliveryTest", $json);
      if ($result["result"] === "ok") {
        $result_status = true;
      } else {
        $result_status = false;
      }
    } else {
      $input_validity = false;
    }
?>
<html>
  <head>
    <title>
    配達物の追加 - 配way
    </title>
    <link rel="shortcut icon" type="image/png" href="../favicon.png"> 
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap-theme.min.css">

    <!-- import jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <script src="../../jquery-3.3.1.min.js"></script>
  </head>
  <body>
    <?php
      include '../header.php';
      write_header("delivery");
    ?>
    <div style="margin: 2em;">
      <h3 style="margin-left: 1em;">追加結果</h3>
      <?php
        if ($input_validity) {
          if ($result_status) {
            print("配達物の追加に成功しました。");
            print("<a class='btn' href='detail.php?slip_number=".$slip_number."'>追加した配達物の詳細</a><br />");
            print("<a href='index.php'>一覧画面</a>");
          } else {
            print("配達物の追加に失敗しました。サーバ側の問題である可能性が高いです。<br />");
            print("<a href='javascript:history.back()'>戻る</a>");
          }
        } else {
          print("配達物の追加に失敗しました。入力値が妥当でない可能性があります。<br />");
          print("<a href='javascript:history.back()'>戻る</a>");
        }
      ?>
    </div>
  </body>
</html>