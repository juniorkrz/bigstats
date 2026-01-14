<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php

require_once "app/config.php";
$appName = $_ENV['APP_NAME'] ?? 'Big Stats';
$appVersion = $_ENV['APP_VERSION'] ?? '1.0.0';
$pageTitle = 'Ranking';
$currentYear = date('Y');

try {
  $lastCommitHash = getLastCommitHash();
} catch (Exception $e) {
  $lastCommitHash = bin2hex(random_bytes(16));
}

/* $lastCommitHash = bin2hex(random_bytes(16)); */

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#3358f4">
  <meta name="apple-mobile-web-app-status-bar-style" content="#3358f4">
  <meta name="msapplication-navbutton-color" content="#3358f4">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon/apple-icon.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="./assets/manifest/site.webmanifest">
  <title>
    <?php echo "$appName $currentYear - $pageTitle" ?>
  </title>
  <!-- CSS -->
  <?php require_once('./components/css.php'); ?>
  <link href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css.css" rel="stylesheet">
  <!-- Tags -->
  <?php require_once('./components/tags.php'); ?>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php require_once('./components/sidebar.php'); ?>
    <div class="main-panel" data="blue">
      <!-- Navbar -->
      <?php require_once('./components/navbar.php'); ?>
      <div id="loader" class="content d-flex justify-content-center align-items-center">
        <div class="spinner"></div>
      </div>
      <div id="stats" class="content d-none animate__animated animate__fadeIn">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header">
              <h4 class="card-title"> Participantes</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive ps">
                <table class="table tablesorter " id="participantsTable">
                </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                  <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                  <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php require_once('./components/footer.php'); ?>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
  <!--  Notifications Plugin    -->
  <!-- <script src="./assets/js/plugins/bootstrap-notify.js"></script> -->
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/black-dashboard.js?v=<?php echo $lastCommitHash ?>"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="./assets/demo/demo.js"></script> -->
  <script src="./assets/js/ranking.js?v=<?php echo $lastCommitHash ?>"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        startApp();
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');
        $block = $('.block');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });

        // Active Navigation
        $('.sidebar li a').each(function() {
          const currentPage = window.location.pathname.split("/").pop();
          const thisPage = this.href.split("/").pop();
          console.log(currentPage, thisPage);
          if (currentPage == thisPage) {
            $(this).closest('li').addClass('active');
          }
        });
      });
    });
  </script>
</body>

</html>