<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Academia - Sistema</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    
    <!-- Custom Styles -->
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            padding-top: 70px; /* para navbar fixed */
        }
        .carousel-inner img {
            height: 400px;
            object-fit: cover;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
        }
        footer a {
            color: #ffc107;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
  <div class="container">
    <a class="navbar-brand font-weight-bold" href="#">Academia</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain" 
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="#fotos">Fotos</a></li>
        <li class="nav-item"><a class="nav-link" href="#sobre">Sobre Nós</a></li>
        <li class="nav-item"><a class="nav-link" href="#planos">Planos</a></li>
        <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
        <li class="nav-item ml-lg-3">
          <a href="views/alunos/painel.php" class="btn btn-warning font-weight-bold">Cadastre-se</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
