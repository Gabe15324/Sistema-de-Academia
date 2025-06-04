<?php
// index.php atualizado
require 'config/db.php';
$conn = Database::conectar();

$stmt = $conn->query("SELECT * FROM planos ORDER BY valor ASC");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';

?>
<<<<<<< HEAD

<!-- Boas-vindas -->
<section class="jumbotron text-center bg-dark text-white">
=======
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Carrossel Fotos -->
<section id="fotos" class="mt-4">
>>>>>>> 961ea868c5e8e59748e860a2f9cfb00e8bb1b41f
  <div class="container">
    <h1 class="display-4">Bem-vindo à Academia Bomber Gym!</h1>
    <p class="lead">Transforme seu corpo e sua mente com nossos planos personalizados e equipe especializada.</p>
    <a href="Planos.php" class="btn btn-danger btn-lg">Conheça nossos planos</a>
  </div>
</section>

<!-- Carrossel fullscreen -->
<section id="fotos">
  <div class="container-fluid p-0">
    <div id="carouselFotos" class="carousel slide carousel-fade" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselFotos" data-slide-to="0" class="active"></li>
        <li data-target="#carouselFotos" data-slide-to="1"></li>
        <li data-target="#carouselFotos" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="assets/overall.jpg" class="d-block w-100" style="height: 100vh; object-fit: cover;" alt="Treino na academia">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
            <h5 class="text-white">Equipamentos modernos</h5>
            <p class="text-light">Garanta resultados com o melhor em tecnologia fitness.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/overall2.jpg" class="d-block w-100" style="height: 100vh; object-fit: cover;" alt="Aulas em grupo">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
            <h5 class="text-white">Aulas dinâmicas</h5>
            <p class="text-light">MMA, Crossfit, Funcional e muito mais.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="assets/overall3.jpg" class="d-block w-100" style="height: 100vh; object-fit: cover;" alt="Equipe de treinadores">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
            <h5 class="text-white">Equipe dedicada</h5>
            <p class="text-light">Profissionais para acompanhar seu progresso.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselFotos" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#carouselFotos" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
      </a>
    </div>
  </div>
</section>
<<<<<<< HEAD

=======
>>>>>>> 961ea868c5e8e59748e860a2f9cfb00e8bb1b41f
<?php include 'includes/footer.php'; ?>
