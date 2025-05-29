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

<!-- Sobre Nós -->
<section id="sobre" class="bg-light text-center py-5 mt-5 shadow-sm">
  <div class="container">
    <h2 class="mb-3 font-weight-bold">Sobre Nós</h2>
    <p class="lead mx-auto" style="max-width: 700px;">
      Somos uma academia comprometida em transformar vidas com planos flexíveis, infraestrutura moderna e uma equipe dedicada ao seu sucesso.
    </p>
  </div>
</section>

<section id="planos" class="py-5">
  <div class="container">
    <h2 class="text-center mb-5 font-weight-bold">Nossos Planos</h2>
    <div class="row">
      <?php foreach ($planos as $plano) : ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm border-primary">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title font-weight-bold"><?= htmlspecialchars($plano['nome']) ?></h5>
              <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($plano['descricao'])) ?></p>
              <ul class="list-unstyled mb-3">
                <li><strong>Valor:</strong> R$ <?= number_format($plano['valor'], 2, ',', '.') ?></li>
                <li><strong>Duração:</strong> <?= (int)$plano['duracao_dias'] ?> dias</li>
              </ul>
              <a href="views/alunos/create.php?plano_id=<?= $plano['id'] ?>" class="btn btn-outline-primary btn-block mt-auto font-weight-bold">
                Escolher este Plano
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Contato -->
<section id="contato" class="bg-light text-center py-4 mt-4">
  <div class="container">
    <h2 class="font-weight-bold mb-3">Contato</h2>
    <p>Email: <a href="mailto:contato@academia.com.br">contato@academia.com.br</a></p>
    <p>Telefone: (41) 99999-9999</p>
    <p>Endereço: Rua Exemplo, 123 - Cidade - Estado</p>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
