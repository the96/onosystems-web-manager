<?php
require_once './func.php';
auth();

if (isset($_GET['slip_number']) &&
    isset($_POST['delivered_status']) &&
    isset($_POST['receivable_status'])) {
  $input_validity = true;
  $slip_number = convert($_GET['slip_number']);
  $delivered_status = convert($_POST['delivered_status']);
  $receivable_status = convert($_POST['receivable_status']);
  $body = array(
    "slip_number" => $slip_number,
    "delivered_status" => $delivered_status,
    "receivable_status" => $receivable_status
  );
  $json = json_encode($body, JSON_UNESCAPED_UNICODE);
  $result = post("https://www.onosystems.work/aws/UpdateDeliveryTest", $json);
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
    onosystems web manager
    </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">

    <!-- import jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../jquery-3.3.1.min.js"></script>
  </head>
  <body>
    <div style="margin: 2em;">
      <h3 style="margin-left: 1em;">更新結果</h3>
      <?php
        if ($input_validity) {
          if ($result_status) {
            print("配達物の状態を更新しました。<br />");
            print("<a href='detail.php?slip_number=".$slip_number."'>配達物の詳細</a><br />");
          } else {
            print("配達物の状態の更新に失敗しました。サーバ側の問題である可能性が高いです。<br />");
          }
        } else {
          print("配達物の状態の更新に失敗しました。入力値が妥当でない可能性があります。<br />");
        }
      ?>
      <a href='index.php'>一覧画面</a>
    </div>
  </body>
</html>