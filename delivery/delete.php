<?php
require_once '../func.php';
auth();

if (isset($_GET['slip_number'])) {
    $input_validity = true;
    $slip_number = convert($_GET['slip_number']);
    $body = array(
      "slip_number" => $slip_number
    );
    $json = json_encode($body, JSON_UNESCAPED_UNICODE);
    $result = post("https://www.onosystems.work/aws/DeleteDeliveryTest", $json);
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
    配達物の削除 - 配way
    </title>
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
      <h3 style="margin-left: 1em;">削除結果</h3>
      <?php
        if ($input_validity) {
          if ($result_status) {
            print("配達物の削除に成功しました。<br />");
          } else {
            print("配達物の削除に失敗しました。サーバ側の問題である可能性が高いです。<br />");
          }
        } else {
          print("配達物の削除に失敗しました。入力値が妥当でない可能性があります。<br />");
        }
      ?>
      <a href='index.php'>一覧画面</a>
    </div>
  </body>
</html>