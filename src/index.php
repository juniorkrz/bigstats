<?php
require_once "app/config.php";
$appName = $_ENV['APP_NAME'] ?? 'Big Stats';
$appVersion = $_ENV['APP_VERSION'] ?? '1.0.0';
$pageTitle = 'Participantes';
$currentYear = date('Y');

$lastCommitHash = bin2hex(random_bytes(16));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#3358f4">
    <title><?php echo "$appName $currentYear - $pageTitle"?></title>
    <?php require_once('./components/css.php'); ?>
    <?php require_once('./components/tags.php'); ?>
</head>
<body class="dark-edition">
<div class="wrapper">
    <?php require_once('./components/sidebar.php'); ?>

    <div class="main-panel">
        <?php require_once('./components/navbar.php'); ?>
      <div id="loader" class="content d-flex justify-content-center align-items-center">
        <div class="spinner"></div>
      </div>
        <div id="stats" class="content d-none animate__animated animate__fadeIn">
            <div class="container-fluid">
                <div class="participantes d-flex justify-content-center align-items-center mb-3">
                    <div class="row w-100 d-flex justify-content-center align-items-center">
                        <!-- <div class="participante avatar-cabecograma mx-1">
                        <img src="./assets/img/default-avatar.png" alt="Adriene">
                        </div> -->
                    </div>
                </div>
                <!-- Profile Header -->
                <div class="row justify-content-center mb-5">
                    <div class="col-12 text-center">
                        <div class="profile-header">
                            <img class="profile-avatar participante rounded-circle" 
                                 data="foto" 
                                 src="./assets/img/default-avatar.png" 
                                 alt="Participante">
                            <img src="./assets/img/verificado.webp" 
                                 class="verified-badge d-none participante" 
                                 data="verificado" 
                                 width="30" 
                                 alt="Verificado">
                        </div>
                        <h2 class="participante mb-2" data="nome"></h2>
                        <a href="#" class="btn btn-instagram btn-round participante" data="instagram">
                            <span class="instagram-handle participante" data="instagram_username"></span>
                        </a>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card stats-card mb-4">
                            <div class="card-body text-center">
                                <div class="stats-number participante" data="seguidores">0</div>
                                <div class="stats-label">Seguidores</div>
                                <div class="mt-3">
                                    <i class="fas fa-users fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stats-card mb-4">
                            <div class="card-body text-center">
                                <div class="stats-number participante" id="ultimos30dias" data="crescimento_30_dias_percentual">0%</div>
                                <div class="stats-label">Últimos 30 dias</div>
                                <div class="mt-3 participante" data="crescimento_30_dias">
                                    <i class="fas fa-calendar-alt fa-2x text-success"></i> <span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stats-card mb-4">
                            <div class="card-body text-center">
                                <div class="stats-number participante" id="crescimentoSemanal" data="crescimento_semanal_percentual">+0%</div>
                                <div class="stats-label">última semana</div>
                                <div class="mt-3 participante" data="crescimento_semanal">
                                    <i class="fas fa-arrow-up fa-2x text-info"></i> <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Evolução de Seguidores</h4>
                                <p class="card-category">Últimos 30 dias</p>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="followersChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Sobre</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome Completo</label>
                                            <p class="participante" data="nome_completo">-</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Idade</label>
                                            <p class="participante" data="idade">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Profissão</label>
                                            <p class="participante" data="profissao">-</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Cidade/Estado</label>
                                            <p class="participante" data="cidade_estado">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Detalhes</label>
                                    <p class="participante" data="detalhes">Sem detalhes disponível.</p>
                                </div>
                                <div class="form-group">
                                    <label>Biografia Instagram</label>
                                    <p class="participante" data="biografia">Sem biografia disponível.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require_once('./components/footer.php'); ?>
    </div>
</div>

<!-- JS -->
<script src="./assets/js/core/jquery.min.js"></script>
<script src="./assets/js/core/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="./assets/js/black-dashboard.js?v=<?php echo $lastCommitHash ?>"></script>
<script src="./assets/js/app.js?v=<?php echo $lastCommitHash ?>"></script>

<script>
$(document).ready(function () {
    // Initialize app
    startApp();

    // Highlight current page in sidebar
    $('.sidebar li a').each(function () {
        let currentPage = window.location.pathname.split("/").pop() || "index.php";
        if (this.href.split("/").pop() === currentPage) {
            $(this).closest('li').addClass('active');
        }
    });
});
</script>
</body>
</html>