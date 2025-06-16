<?php
require 'config/db.php';
$conn = Database::conectar();
$stmt = $conn->query("SELECT * FROM planos ORDER BY valor ASC");
$planos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$users = [
  ['name' => 'Cbum', 'img' => 'cbum.png', 'text' => 'Excelente academia! Os treinos são personalizados e os professores são muito atenciosos.'],
  ['name' => 'Ramon', 'img' => 'ramon.png', 'text' => 'Ambiente limpo, organizado e com equipamentos modernos. Recomendo demais!'],
  ['name' => 'Urs', 'img' => 'urs.png', 'text' => 'Consegui atingir meus objetivos em poucos meses. A equipe está de parabéns!']
];


$faqs = [
  ['q' => 'Como faço para me inscrever?', 'a' => 'Basta clicar no "Planos" desejado e preencher seus dados.'],
  ['q' => 'Contato dos Proficionais responsaveis?', 'a' => 'Em contatos, você vai encontrar os donos da Academia.'],
  ['q' => 'Quais são os horários das aulas?', 'a' => 'Oferecemos aulas desde cedo das 05:00 até noite 23:00S.'],
];


if (isset($_GET['cookie'])) {
    if ($_GET['cookie'] === 'aceitar') {
        setcookie('visitou_site', 'sim', time() + (365 * 24 * 60 * 60), "/");
    } elseif ($_GET['cookie'] === 'recusar') {
        setcookie('visitou_site', 'nao', time() + (365 * 24 * 60 * 60), "/");
    }
    header("Location: index.php");
    exit;
}

include 'includes/header.php';
?>

<main class="bg-dark text-light">



  <?php if (!isset($_COOKIE['visitou_site'])): ?>
    <div style="position:fixed; bottom:0; width:100%; background-color:#343a40; color:white; padding:15px; z-index:9999;" class="text-center">
      <p class="mb-2">🍪 Este site usa cookies para melhorar sua experiência.</p>
      <a href="?cookie=aceitar" class="btn btn-success btn-sm">Aceitar</a>
      <a href="?cookie=recusar" class="btn btn-danger btn-sm">Recusar</a>
    </div>
  <?php endif; ?>
  
  <section class="d-flex align-items-center justify-content-center text-center vh-100" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('assets/hero.png') center/cover;">
    <div class="px-3">
      <h1 class="display-4 font-weight-bold">Bem-vindo à <span class="text-warning">Bomber Gym</span></h1>
      <p class="lead mb-4">Estrutura completa, equipe qualificada e planos feitos para você transformar sua vida.</p>
      <a href="Planos.php" class="btn btn-warning btn-lg mr-2 shadow">Conheça os Planos</a>
      <a href="contatos.php" class="btn btn-outline-light btn-lg shadow">Fale com a gente</a>
    </div>
  </section>

  <section id="destaques" class="bg-dark text-white py-5">
    <div class="container">
      <h2 class="text-center mb-4 font-weight-bold text-warning">O que oferecemos</h2>
      <div class="row text-center">
        <?php
        $itens = [
          ['icon' => 'dumbbell', 'title' => 'Equipamentos Modernos', 'text' => 'Máquinas e pesos livres de qualidade profissional para treinos eficientes.'],
          ['icon' => 'chalkboard-teacher', 'title' => 'Instrutores Qualificados', 'text' => 'Nossos profissionais estão prontos para te orientar nos seus objetivos.'],
          ['icon' => 'users', 'title' => 'Aulas Coletivas', 'text' => 'Yoga, Spinning, HIIT e muito mais, com horários variados para seu conforto.'],
        ];
        foreach ($itens as $item): ?>
        <div class="col-md-4 mb-4">
          <div class="p-4 rounded bg-secondary shadow-sm">
            <i class="fas fa-<?= $item['icon'] ?> fa-3x text-warning mb-3"></i>
            <h4 class="text-light"><?= $item['title'] ?></h4>
            <p><?= $item['text'] ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="bg-dark text-white py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4 text-center mb-3 mb-md-0">
          <img src="assets/image.png" alt="Equipe" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-4 text-center text-md-left">
          <h2 class="font-weight-bold text-danger">NO PAIN - NO GAIN!</h2>
          <ul class="mt-4">
            <li>ESSE É O NOSSO LEMA, SUPORTE-O!</li>
          </ul>
        </div>
        <div class="col-md-4 text-center">
          <img src="assets/image.png" alt="Equipe" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </section>

  <section class="bg-secondary text-light py-5">
    <div class="container">
      <h2 class="text-center mb-5 font-weight-bold text-warning">Depoimentos</h2>
      <div class="row">
        <?php foreach ($users as $u): ?>
          <div class="col-md-4 mb-4">
            <div class="media p-4 bg-dark rounded shadow-sm">
              <img src="assets/<?= $u['img'] ?>" class="mr-3 rounded-circle" width="64" alt="<?= $u['name'] ?>">
              <div class="media-body">
                <h5 class="mt-0 text-warning"><?= $u['name'] ?></h5>
                <p><?= $u['text'] ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="py-5 text-center bg-dark">
    <div class="container">
      <h2 class="font-weight-bold mb-4 text-warning">Dúvidas Frequentes</h2>
      <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $i => $faq): ?>
          <div class="card border-0 mb-3 bg-secondary text-light shadow-sm">
            <div class="card-header p-3 bg-secondary" id="heading<?= $i ?>">
              <h2 class="mb-0">
                <button class="btn btn-link text-left text-warning" style="text-decoration: none;" type="button"
                  data-toggle="collapse" data-target="#collapse<?= $i ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>"
                  aria-controls="collapse<?= $i ?>">
                  <?= $faq['q'] ?>
                </button>
              </h2>
            </div>
            <div id="collapse<?= $i ?>" class="collapse <?= $i === 0 ? 'show' : '' ?>" data-parent="#faqAccordion">
              <div class="card-body text-left bg-dark text-light border-top border-warning">
                <?= $faq['a'] ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="py-5 text-center bg-warning text-dark">
    <div class="container">
      <h2 class="mb-4 font-weight-bold">Pronto para mudar sua rotina?</h2>
      <a href="Planos.php" class="btn btn-dark btn-lg shadow">Faça sua matrícula, e conheça os nossos planos</a>
    </div>
  </section>

</main>

<?php if (!isset($_COOKIE['visitou_site'])): ?>
  <div id="cookie-banner" class="position-fixed w-100 bg-dark text-light p-3" style="bottom: 0; z-index: 9999;">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
      <span>🍪 Utilizamos cookies para melhorar sua experiência. Ao aceitar, você concorda com nossa <a href="#" class="text-warning">política de privacidade</a>.</span>
      <div class="mt-2 mt-md-0">
        <button id="aceitar-cookies" class="btn btn-sm btn-warning">Aceitar</button>
        <button id="recusar-cookies" class="btn btn-sm btn-outline-light">Recusar</button>
      </div>
    </div>
  </div>
<?php endif; ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const aceitar = document.getElementById('aceitar-cookies');
    const recusar = document.getElementById('recusar-cookies');

    function esconderBanner() {
      const banner = document.getElementById('cookie-banner');
      if (banner) banner.style.display = 'none';
    }

    if (aceitar) {
      aceitar.addEventListener('click', function () {
        document.cookie = "visitou_site=sim; path=/; max-age=" + (30 * 24 * 60 * 60);
        esconderBanner();
      });
    }

    if (recusar) {
      recusar.addEventListener('click', function () {
        esconderBanner();
      });
    }
  });
</script>

<?php include 'includes/footer.php'; ?>
