<?php
require_once "app/config.php";
$appName = $_ENV['APP_NAME'] ?? 'Big Stats';
$appVersion = $_ENV['APP_VERSION'] ?? '1.0.0';
$pageTitle = 'Detalhes do Participante';
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
    <style>
        .profile-header {
            position: relative;
            margin-bottom: 2rem;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .verified-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #fff;
            border-radius: 50%;
            padding: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .stats-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1d8cf8;
        }
        .stats-label {
            color: #8898aa;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .social-stats {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin: 1.5rem 0;
        }
        .social-stat {
            padding: 0 1rem;
        }
        .social-stat:not(:last-child) {
            border-right: 1px solid #e9ecef;
        }
        .btn-instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
            color: white !important;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-instagram:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
</head>
<body class="dark-edition">
<div class="wrapper">
    <?php require_once('./components/sidebar.php'); ?>

    <div class="main-panel">
        <?php require_once('./components/navbar.php'); ?>

        <div id="stats" class="content">
            <div class="container-fluid">
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
                            <i class="fab fa-instagram mr-2"></i> @<span class="instagram-handle"></span>
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
                                <div class="stats-number" id="engajamento">0%</div>
                                <div class="stats-label">Taxa de Engajamento</div>
                                <div class="mt-3">
                                    <i class="fas fa-chart-line fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stats-card mb-4">
                            <div class="card-body text-center">
                                <div class="stats-number" id="crescimento">+0%</div>
                                <div class="stats-label">Crescimento Mensal</div>
                                <div class="mt-3">
                                    <i class="fas fa-arrow-up fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row">
                    <div class="col-lg-8">
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
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Distribuição de Seguidores</h4>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="demographicsChart" height="300"></canvas>
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
                                    <label>Biografia</label>
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

    // Initialize charts
    function initCharts() {
        // Followers Line Chart
        const ctx1 = document.getElementById('followersChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: Array.from({length: 30}, (_, i) => i + 1 + ' ' + new Date().toLocaleString('default', { month: 'short' })),
                datasets: [{
                    label: 'Seguidores',
                    data: Array.from({length: 30}, () => Math.floor(Math.random() * 1000) + 5000),
                    borderColor: '#1d8cf8',
                    backgroundColor: 'rgba(29, 140, 248, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });

        // Demographics Doughnut Chart
        const ctx2 = document.getElementById('demographicsChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Feminino', 'Masculino', '18-24', '25-34', '35-44', '45+'],
                datasets: [{
                    data: [65, 35, 40, 35, 15, 10],
                    backgroundColor: [
                        '#e14eca',
                        '#1d8cf8',
                        '#00f2c3',
                        '#ff8d72',
                        '#fd5d93',
                        '#ff7d4d'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // Initialize charts after a small delay to ensure DOM is ready
    setTimeout(initCharts, 500);
});
</script>
</body>
</html>