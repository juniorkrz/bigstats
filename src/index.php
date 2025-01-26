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

try {
  $lastCommitHash = getLastCommitHash();
} catch (Exception $e) {
  $lastCommitHash = bin2hex(random_bytes(16));
}

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
    <?php echo $appName ?> 2025 - Estatísticas
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="./assets/css/black-dashboard.css?v=<?php echo $lastCommitHash ?>" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/custom.css?v=<?php echo $lastCommitHash ?>">
  <script type="text/javascript">
    (function(c, l, a, r, i, t, y) {
      c[a] = c[a] || function() {
        (c[a].q = c[a].q || []).push(arguments)
      };
      t = l.createElement(r);
      t.async = 1;
      t.src = "https://www.clarity.ms/tag/" + i;
      y = l.getElementsByTagName(r)[0];
      y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "pzpx6tccj0");
  </script>
</head>

<body>
  <div class="wrapper">
    <div class="sidebar" data="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            BS
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            <?php echo $appName ?>
          </a>
        </div>
        <ul class="nav">
          <li class="active">
            <a href="./index.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Duplas</p>
            </a>
          </li>
          <!-- <li>
            <a href="./index.html">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Ranking</p>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
    <div class="main-panel" data="blue">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center w-100">
            <div class="navbar-wrapper d-flex align-items-center">
              <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="navbar-brand" href="javascript:void(0)">Estatísticas</a>
            </div>
            <div class="collapse navbar-collapse show" id="navigation">
              <ul class="navbar-nav ml-auto d-flex">
                <div class="form-check form-switch d-flex align-items-center flex-row-reverse">
                  <!-- <label class="form-check-label" for="flexSwitchCheckChecked">Exibição automática</label> -->
                  <input id="autoSwitch" class="form-check-input mb-1" type="checkbox" role="switch" checked="">
                </div>
                <li class="separator d-lg-none"></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div id="loader" class="content d-flex justify-content-center align-items-center">
        <div class="spinner"></div>
      </div>
      <div id="stats" class="content d-none animate__animated animate__fadeIn">
        <div class="participantes d-flex justify-content-center align-items-center mb-3">
          <div class="row w-100 d-flex justify-content-center align-items-center">
            <!-- <div class="duo">
              <img class="mx-1" src="./assets/img/default-avatar.png" alt="">
              <img class="mx-1" src="./assets/img/default-avatar.png" alt="">
            </div> -->
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category participanteA" data="nome"></h5>
                <h3 class="card-title"><i class="fab fa-instagram text-danger"></i> <span class="participanteA" data="seguidores"></span></h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartParticipanteA"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-user">
              <div class="card-body">
                <p class="card-text"></p>
                <div class="duo-profiles d-flex justify-content-between align-items-center">
                  <!-- Primeiro perfil -->
                  <div class="author text-center">
                    <div data="blue" class="block block-one"></div>
                    <div data="blue" class="block block-two"></div>
                    <div data="blue" class="block block-three"></div>
                    <div data="blue" class="block block-four"></div>
                    <div class="profile-image-wrapper">
                      <a href="javascript:void(0)" class="profile-wrapper">
                        <img class="avatar participanteA d-none" data="foto" alt="...">
                      </a>
                      <img src="./assets/img/verificado.webp" class="verified-badge d-none participanteA" data="verificado" alt="Verificado">
                    </div>
                    <h5 class="title participanteA" data="nome"></h5>
                    <button href="javascript:void(0)" class="btn btn-icon btn-round btn-instagram participanteA" data="instagram">
                      <i class="fab fa-instagram text-danger"></i>
                    </button>
                  </div>
                  <!-- Segundo perfil -->
                  <div class="author text-center">
                    <div class="profile-image-wrapper">
                      <a href="javascript:void(0)" class="profile-wrapper">
                        <img class="avatar participanteB d-none" data="foto" alt="...">
                      </a>
                      <img src="./assets/img/verificado.webp" class="verified-badge d-none participanteB" data="verificado" alt="Verificado">
                    </div>
                    <h5 class="title participanteB" data="nome"></h5>
                    <button href="javascript:void(0)" class="btn btn-icon btn-round btn-instagram participanteB" data="instagram">
                      <i class="fab fa-instagram text-danger"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center description dupla" data="grauRelacaoFormatada">
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category participanteB" data="nome"></h5>
                <h3 class="card-title"><i class="fab fa-instagram text-danger"></i> <span class="participanteB" data="seguidores"></span></h3>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartParticipanteB"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card card-chart">
              <div class="card-header ">
                <div class="row">
                  <div class="col-sm-6 text-left">
                    <h5 class="card-category">Dupla</h5>
                    <h3 class="card-title"><i class="fab fa-instagram text-danger"></i> <span class="dupla" data="seguidores"></span></h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="chartDupla"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <ul class="nav">
            <li class="nav-item">
              <a href="./index.php" class="nav-link">
                <?php echo $appName ?>
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link">
                Sobre
              </a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/juniorkrz/bigstats" target="_blank" class="nav-link">
                GIT
              </a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/juniorkrz" target="_blank" class="nav-link">
                Krz
              </a>
            </li>
          </ul>
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> feito com <i class="tim-icons icon-heart-2"></i> por
            <a href="https://github.com/juniorkrz" target="_blank">Krz</a>.
          </div>
        </div>
      </footer>
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
  <!--  Notifications Plugin    -->
  <!-- <script src="./assets/js/plugins/bootstrap-notify.js"></script> -->
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/black-dashboard.js?v=<?php echo $lastCommitHash ?>"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <!-- <script src="./assets/demo/demo.js"></script> -->
  <script src="./assets/js/app.js?v=<?php echo $lastCommitHash ?>"></script>
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
      });
    });
  </script>
</body>

</html>