<?php
require 'config/db.php';
$conn = Database::conectar();

$stmt = $conn->query("SELECT * FROM planos ORDER BY valor ASC");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';

// Array com imagens do carousel (evita repetição)
$carouselImagens = [
  ['src' => 'assets/foto1.png', 'alt' => 'Treino'],
  ['src' => 'assets/foto2.png', 'alt' => 'Aulas'],
  ['src' => 'assets/foto3.png', 'alt' => 'Treinadores'],
  ['src' => 'assets/foto4.png', 'alt' => 'Equipe'],
];
?>

<div class="bg-dark text-light">
  <!-- Hero Section -->
  <section class="d-flex align-items-center justify-content-center text-center vh-100 text-white" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('assets/hero.png') center center / cover no-repeat;">
    <div>
      <h1 class="display-4 font-weight-bold">Bem-vindo à <span class="text-danger">Academia Bomber Gym</span></h1>
      <p class="lead">Transforme seu corpo e sua mente com estrutura de ponta, equipe dedicada e planos sob medida.</p>
      <a href="#planos" class="btn btn-danger btn-lg mt-3 shadow">Conheça nossos Planos</a>
    </div>
  </section>

  <!-- Carousel com Informações -->
  <section id="carousel" class="bg-secondary text-white py-5">
    <div class="container">
      <div class="row align-items-center">
        
        <!-- Carousel (esquerda) -->
        <div class="col-md-6 mb-4 mb-md-0">
          <div id="carouselFotos" class="carousel slide carousel-fade rounded shadow" data-ride="carousel">
            <div class="carousel-inner">
              <?php foreach ($carouselImagens as $index => $img): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                  <img src="<?= $img['src'] ?>" class="d-block w-100 rounded" alt="<?= $img['alt'] ?>">
                </div>
              <?php endforeach; ?>
            </div>
            <a class="carousel-control-prev" href="#carouselFotos" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselFotos" role="button" data-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="sr-only">Próximo</span>
            </a>
          </div>
        </div>

        <!-- Informações (direita) -->
        <div class="col-md-6">
          <h3 class="font-weight-bold text-warning mb-3">Transforme sua rotina na Bomber Gym</h3>
          <p class="lead">Aqui, sua evolução é o nosso compromisso!</p>
          <ul class="list-unstyled">
            <li class="mb-2">💪 Estrutura moderna com equipamentos de ponta</li>
            <li class="mb-2">🧠 Treinos focados no corpo e na mente</li>
            <li class="mb-2">🕒 Horários flexíveis e programas personalizados</li>
            <li class="mb-2">👥 Ambiente acolhedor e motivador</li>
          </ul>
          <a href="Planos.php" class="btn btn-outline-light btn-lg mt-3">Veja nossos planos</a>
        </div>

      </div>
    </div>
  </section>

  <!-- Benefícios -->
  <section class="bg-dark text-white py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 text-center mb-3 mb-md-0">
          <img src="assets/image.png" alt="Equipe" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-4 text-center text-md-left">
          <h2 class="font-weight-bold text-danger">Por que escolher a Bomber Gym?</h2>
          <ul class="mt-4">
            <li>✔️ Equipamentos modernos e bem cuidados</li>
            <li>✔️ Treinadores certificados e atenciosos</li>
            <li>✔️ Aulas coletivas energizantes</li>
            <li>✔️ Ambiente limpo, seguro e climatizado</li>
            <li>✔️ Planos acessíveis para todos os perfis</li>
          </ul>
        </div>
        <div class="col-md-4 text-center">
          <img src="assets/image.png" alt="Equipe" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <section class="py-5 text-center bg-danger text-white">
    <div class="container">
      <h2 class="mb-4">Pronto para começar sua transformação?</h2>
      <a href="cadastro.php" class="btn btn-light btn-lg shadow">Faça sua matrícula agora</a>
    </div>
  </section>
</div>

<?php include 'includes/footer.php'; ?>
