<?php
require 'config/db.php';
$conn = Database::conectar();

$stmt = $conn->query("SELECT * FROM planos ORDER BY valor ASC");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<!-- AOS Animate On Scroll -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<section id="planos" class="py-5 bg-dark text-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-4 font-weight-bold text-danger">Nossos Planos</h2>
      <p class="lead text-secondary">Escolha o plano ideal para sua transformação</p>
      <hr class="bg-danger w-25 mx-auto">
    </div>

    <div class="row">
      <?php foreach ($planos as $index => $plano) : ?>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
          <div class="card h-100 border-0 shadow-lg bg-secondary text-white transition scale-hover">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-danger font-weight-bold"><?= htmlspecialchars($plano['nome']) ?></h5>
              <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($plano['descricao'])) ?></p>
              <ul class="list-unstyled mb-3">
                <li><strong>💰 Valor:</strong> R$ <?= number_format($plano['valor'], 2, ',', '.') ?></li>
                <li><strong>⏱ Duração:</strong> <?= (int)$plano['duracao_dias'] ?> dias</li>
              </ul>
              <a href="cadastro.php?plano_id=<?= $plano['id'] ?>" class="btn btn-outline-danger btn-block font-weight-bold">
                Escolher este Plano
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- AOS Script -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
  });
</script>

<!-- Bootstrap-only hover scale (optional helper) -->
<style>
  .scale-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .scale-hover:hover {
    transform: scale(1.03);
    box-shadow: 0 0 15px rgba(220, 53, 69, 0.6);
  }
</style>

<?php include 'includes/footer.php'; ?>
