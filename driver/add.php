<?php
require_once '../func.php';
auth();

if (isset($_POST['name']) && 
    isset($_POST['mail']) &&
    isset($_POST['tel']) &&
    isset($_POST['store_code']) &&
    isset($_POST['password']) &&
    isset($_POST['password_again'])) {
      $input_validity = true;
      $name = convert($_POST['name']);
      $mail = convert($_POST['mail']);
      $tel = convert($_POST['tel']);
      $store_code = convert($_POST['store_code']);
      $password = convert($_POST['password']);
      $password_again = convert($_POST['password_again']);
      if ($password === $password_again) {
        $double_check = true;
        $body = array(
          "name" => $name,
          "mail" => $mail,
          "tel" => $tel,
          "store_code" => $store_code,
          "password" => $password,
          "token" => ""
        );
        $json = json_encode($body, JSON_UNESCAPED_UNICODE);
        $result = post("https://www.onosystems.work/aws/InsertCourierTest", $json);
        if ($result["result"] === "ok") {
          $result_status = true;
          $driver_id = $result["driver_id"];
        } else {
          $result_status = false;
        }
      } else {
        $double_check = false;
      }
    } else {
      $input_validity = false;
    }
?>
<html>
  <head>
    <title>
    ドライバーの追加 - 配way
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
      write_header("driver");
    ?>
    <div style="margin: 2em;">
      <h3 style="margin-left: 1em;">追加結果</h3>
      <?php
        if ($input_validity) {
          if ($double_check) {
            if ($result_status) {
              print("ドライバーの追加に成功しました。<br />");
              print("<a class='btn' href='detail.php?driver_id=".$driver_id."'>追加したドライバーの詳細</a><br />");
              print("<a href='index.php'>一覧画面</a>");
            } else {
              print("ドライバーの追加に失敗しました。サーバ側の問題である可能性が高いです。<br />");
              print("<a href='javascript:history.back()'>戻る</a>");
            }
          } else {
            print("ご入力いただいた2つのパスワードが一致しませんでした。<br />");
            print("<a href='javascript:history.back()'>戻る</a>");
          }
        } else {
          print("ドライバーの追加に失敗しました。入力値が妥当でない可能性があります。<br />");
          print("<a href='javascript:history.back()'>戻る</a>");
        }
      ?>
    </div>
  </body>
</html>