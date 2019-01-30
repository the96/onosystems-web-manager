<?php
require_once '../func.php';
auth();
$body = array();
$result = post("https://www.onosystems.work/aws/SelectCourierTest", body);

?>
<html>
  <head>
    <title>
    ドライバー一覧 - 配way
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
    <script type="text/javascript">
      function dialog(){
        return confirm("ドライバーアカウントを削除しますか？");
      }
    </script>
  </head>
  <body>
    <?php
    include '../header.php';
    write_header("driver");
    ?>
    <h3 class="text-center" style="margin-top:1em">ドライバーアカウント一覧</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <?php
            $keys = array_keys($result[0]);
            foreach($keys as $key) {
              print("<th>".$key."</th>");
            }
          ?>
          <th>delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 0;
          foreach($result as $value) {
            print("<tr>");
            print("<th>".$i."</th>");
            foreach($keys as $key) {
              print("<td>".$value[$key]."</td>");
            }
            print("<td><a class='btn btn-danger' href='delete.php?driver_id=".$value["driver_id"]."' onClick='return dialog();'>削除</a></td>");
            print("</tr>");
            $i++;
          }
        ?>
      </tbody>
    </table>
    <h3 class="text-center" style="margin-top: 2em;">ドライバー追加</h3>
    <div class="container">
      <form action="add.php" method="post" class="form-horizontal">
        <div class="row">
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>mail</label>
            <input type="text" name="mail" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>tel</label>
            <input type="tel" name="tel" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>store_code</label>
            <input type="text" name="store_code" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>password</label>
            <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>password(agin)</label>
            <input type="password" name="password_again" class="form-control">
          </div>
        </div>
        <div class="form-group text-center">
          <button type="submit" class="btn btn-default">追加</button>
        </div>
      </form>
    </div>
  </body>
</html>