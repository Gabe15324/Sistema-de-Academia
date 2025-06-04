<?php
require 'config/db.php';
$conn = Database::conectar();

$stmt = $conn->query("SELECT * FROM planos ORDER BY valor ASC");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section id="planos" class="">
  <div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center mb-2 font-weight-bold">Nossos Planos</h2>
            <hr>
            <div class="row">
            <?php foreach ($planos as $plano) : ?>
                <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-danger">
                    <div class="card-body d-flex flex-column">
                    <h5 class="card-title font-weight-bold"><?= htmlspecialchars($plano['nome']) ?></h5>
                    <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($plano['descricao'])) ?></p>
                    <ul class="list-unstyled mb-3">
                        <li><strong>Valor:</strong> R$ <?= number_format($plano['valor'], 2, ',', '.') ?></li>
                        <li><strong>Duração:</strong> <?= (int)$plano['duracao_dias'] ?> dias</li>
                    </ul>
                    <a href="views/alunos/create.php?plano_id=<?= $plano['id'] ?>" class="btn btn-outline-danger btn-block mt-auto font-weight-bold">
                        Escolher este Plano
                    </a>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>