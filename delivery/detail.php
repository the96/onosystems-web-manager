<?php
require_once '../func.php';
auth();

function get_radio_group ($name, $default) {
  switch($name) {
    case "delivered_status":
    case "receivable_status":
      $str = '<div class="btn-group btn-group-toggle" data-toggle="buttons">';
      for ($i = 0; $i < get_radio_size($name) ; $i++) {
        $str = $str . get_radio($name, $i, $default == $i);
      }
      $str = $str . '</div>';
      return $str;
    default:
    return "";
  }
}

function get_radio ($name, $value, $checked) {
  return "<label class='btn btn-info ".($checked?"active":"")."'>".
         "<input type='radio' name='".$name."' value='".$value."' autocomplete='off' ".($checked?"checked='checked'":"").">" . get_label($name, $value) .
         "</label>";
}

function get_radio_size($name) {
  global $delivered_status_labels, $receivable_status_labels;
  switch ($name) {
    case "delivered_status":
      return count($delivered_status_labels);
    case "receivable_status":
      return count($receivable_status_labels);
    default:
      return -1;
  }
}

function get_label($name, $value) {
  if (is_bool($value)) {
    return get_bool_label($value);
  }

  global $delivery_time_labels, $delivered_status_labels, $receivable_status_labels;

  switch ($name) {
    case "delivery_time":
      return get_label_from_array($delivery_time_labels, $value);
    case "delivered_status":
      return get_label_from_array($delivered_status_labels, $value);
    case "receivable_status":
      return get_label_from_array($receivable_status_labels, $value);
    default:
      return $value;
  }
}

function get_label_from_array($array, $value) {
  $index = (int) $value;
  if ($index < count($array)) {
    return $array[$index];
  } else {
    return "out of bounds";
  }
}

if (isset($_GET['slip_number'])) {
  $slip_number = convert($_GET['slip_number']);
  $body = array(
    "slip_number" => $slip_number
  );
  $json = json_encode($body, JSON_UNESCAPED_UNICODE);
  $result = post("https://www.onosystems.work/aws/DeliveryDetail", $json);
  $keys = array_keys($result);
} 
?>
<html>
  <head>
    <title>
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
    <h3 class="text-center" style="margin-top:1em">配達物の詳細</h3>
    <form action="update.php?slip_number=<?php print($slip_number);?>" method="post">
      <table class="table">
        <thead>
          <tr>
            <th class="col-xs-2 col-ms-2 col-md-2 col-lg-2 col-xl-2">key</th>
            <th class="col-xs-6 col-ms-6 col-md-6 col-lg-7 col-xl-8">value</th>
            <th class="col-xs-4 col-ms-4 col-md-4 col-lg-3 col-xl-2">edit</th>
          </tr>
        </thead>
        <tbody>
        <?php
            foreach($keys as $str) {
              print("<tr>");
              print("<th>".$str."</th>");
              print("<td>".get_label($str, $result[$str])."</td>");
              print("<td>".get_radio_group($str, $result[$str])."</td>");
              print("</tr>");
            }
          ?>
        </tbody>
      </table>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-default">編集確定</button>
      </div>
    </form>
    <div style="padding: 2em 5em;text-align: right">
      <div style="display: inline">
        <a href="index.php" style="text-align: right">一覧画面へ戻る</a>
      </div>
    </div>
  </body>
</html>