<?php
require_once './func.php';
auth();
$body = array();
$result = post("https://www.onosystems.work/aws/DriverTest", body);

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
              print("<td>".$value["key"]."</td>");
            }
          ?>
          <th>jump</th>
          <th>delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 0;
          foreach($result as $value) {
            print("<tr>");
            print("<th>".$i."</th>");
            $keys = array_keys($value);
            foreach($keys as $key) {
              print("<td>".$value["key"]."</td>");
            }
            print("<td><a class='btn btn-info' href='driver/detail.php?driver_id=".$value["driver_id"]."'>詳細</a></td>");
            print("<td><a class='btn btn-danger' href='driver/delete.php?driver_id=".$value["driver_id"]."' onClick='return dialog();'>削除</a></td>");
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
            <label>slip_number</label>
            <input type="text" name="slip_number" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <label>address</label>
            <input type="address" name="address" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>ship_to</label>
            <input type="text" name="ship_to" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>ship_from</label>
            <input type="text" name="ship_from" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>time</label>
            <input type="text" name="time" placeholder="yyyy-mm-dd or yyyy/mm/dd" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>delivery_time</label>
            <select class="form-control" name="delivery_time">
            <!-- 0:時間指定なし、1:9-12、2:12-15、3:15-18、4:18-21 -->
              <option value="0" selected="selected">指定なし</option>
              <option value="1">9-12時</option>
              <option value="2">12-15時</option>
              <option value="3">15-18時</option>
              <option value="4">18-21時</option>
            </select>
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>delivered_status</label>
            <select class="form-control" name="delivered_status">
              <option value="0" selected="selected">未配達</option>
              <option value="1">配達済</option>
            </select>
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>receivable_status</label>
            <select class="form-control" name="receivable_status">
              <option value="0" selected="selected">未回答</option>
              <option value="1">受領不可</option>
              <option value="2">受領可能</option>
            </select>
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>customer_id</label>
            <input type="text" name="customer_id" class="form-control">
          </div>
          <div class="form-group col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <label>driver_id</label>
            <input type="text" name="driver_id" class="form-control">
          </div>
        </div>
        <div class="form-group text-center">
          <button type="submit" class="btn btn-default">追加</button>
        </div>
      </form>
    </div>
  </body>
</html>