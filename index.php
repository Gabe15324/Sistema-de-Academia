<?php
require 'config/db.php';
$conn = Database::conectar();

$stmt = $conn->query("SELECT * FROM planos ORDER BY valor ASC");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Carrossel Fotos -->
<section id="fotos" class="mt-4">
  <div class="container">
    <div id="carouselFotos" class="carousel slide shadow-sm rounded" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselFotos" data-slide-to="0" class="active"></li>
        <li data-target="#carouselFotos" data-slide-to="1"></li>
        <li data-target="#carouselFotos" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner rounded">
        <div class="carousel-item active">
          <img src="assets/overall.jpg" class="d-block w-100" alt="Foto 1" />
        </div>
        <div class="carousel-item">
          <img src="assets/overall2.jpg" class="d-block w-100" alt="Foto 2" />
        </div>
        <div class="carousel-item">
          <img src="assets/overall3.jpg" class="d-block w-100" alt="Foto 3" />
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
<?php include 'includes/footer.php'; ?>
