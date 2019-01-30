<?php
function write_header($type) {
  if ($type == "delivery") {
    $path_del = "index.php";
    $path_dri = "../driver/index.php";
  } else if($type == "driver") {
    $path_del = "../delivery/index.php";
    $path_dri = "index.php";
  }
  print('
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <span class="navbar-brand">配way 管理システム</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="'.$path_del.'">Delivery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="'.$path_dri.'">Driver</a>
          </li>
        </ul>
      </div>
    </nav>
  ');
}
?>