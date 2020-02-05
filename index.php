<?php
include_once("includes/include.php");
if (!isset($_GET['acao']) || empty($_GET['acao'])) {
    header("Location: index.php?acao=inicio");
    exit;
}

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="assets/css/main.css">


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js"></script>


    <title>BENHUR MARQUES - Teste Prático </title>
</head>
<body>

<header>
    <nav id="logo" class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#link-site"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="ml-auto d-none d-lg-block text-right">
                Olá! <strong>Benhur Marques</strong><br/><small>CPF: 987.401.800-34</small>
            </div>
        </div>
    </nav>
    <nav id="menu" class="navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="container">
                <ul class="navbar-nav">

                    <li class="nav-item   <?= isset($_GET['acao']) && $_GET['acao'] == "inicio" ? 'active' : '' ?> "><a
                                class="nav-link" href="?acao=inicio">Início</a></li>

                    <li class="nav-item <?= isset($_GET['acao']) && $_GET['acao'] == "cidades" ? 'active' : '' ?> "><a
                                class="nav-link" href="?acao=cidades">Cidades</a></li>

                    <li class="nav-item <?= isset($_GET['acao']) && $_GET['acao'] == "estados" ? 'active' : '' ?> "><a
                                class="nav-link" href="?acao=estados">Estados</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>


<section>
    <?php
    if (isset($_GET['acao']) && $_GET['acao'] == "cidades") {
        include_once("cidades.php");
    } else if (isset($_GET['acao']) && $_GET['acao'] == "estados") {
        include_once("estados.php");
    } else {
        include_once("home.php");
    }
    ?>
</section>


<footer>© Benhur Marques - Todos os direitos reservados</footer>
</body>
</html>