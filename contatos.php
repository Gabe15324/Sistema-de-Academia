<?php 
include 'includes/header.php';
?>

<!-- Font Awesome para ícones -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<section id="contato" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="font-weight-bold text-dark">Central de Contato</h2>
      <p class="text-muted">Entre em contato com a equipe responsável</p>
      <div class="mx-auto" style="width: 80px; height: 3px; background-color: #dc3545;"></div>
    </div>

    <div class="row">
      <?php 
        $contatos = [
          [
            'nome' => 'Gabriel Brasilio',
            'email' => 'gabrielbrasilio999@gmail.com',
            'telefone' => '(41) 99889-6650',
            'endereco' => 'R. Lacrides Fernandes Santos, 66<br>Curitiba - PR',
            'horario' => 'Seg a Sex - 08h às 18h',
            'instagram' => '@Gabriel',
            'insta_link' => 'https://instagram.com/gabriel_brasilio'
          ],
          [
            'nome' => 'Diego Gabriel',
            'email' => 'russobesc@gmail.com',
            'telefone' => '(41) 99838-3797',
            'endereco' => 'Av. Leopoldo Jacomel, 1234<br>São José dos Pinhais - PR',
            'horario' => 'Seg a Sex - 09h às 17h',
            'instagram' => '@diego',
            'insta_link' => 'https://instagram.com/diego_aws'
          ],
          [
            'nome' => 'Luan Curt',
            'email' => 'curt.luan@gmail.com',
            'telefone' => '(41) 992630926',
            'endereco' => 'Marechal Deodoro, 666<br>Curitiba - PR',
            'horario' => 'Seg a Sex - 07h às 16h',
            'instagram' => '@luancurt',
            'insta_link' => 'https://instagram.com/luancurt'
          ],
          [
            'nome' => 'Jean dias',
            'email' => 'jeandias0803@gmail.com',
            'telefone' => '(41) 90000-1111',
            'endereco' => 'R. XV de Novembro, 321<br>Curitiba - PR',
            'horario' => 'Seg a Sex - 10h às 19h',
            'instagram' => '@JeanDias',
            'insta_link' => 'https://instagram.com/JeanDias'
          ]
        ];

        foreach ($contatos as $contato) :
      ?>
        <div class="col-md-6 col-lg-3 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-danger font-weight-bold mb-3">
                <i class="fas fa-user-circle mr-2"></i><?= $contato['nome'] ?>
              </h5>
              <p><i class="fas fa-envelope text-danger mr-2"></i><strong>Email:</strong><br>
                <a href="mailto:<?= $contato['email'] ?>"><?= $contato['email'] ?></a>
              </p>
              <p><i class="fas fa-phone text-danger mr-2"></i><strong>Telefone:</strong><br> <?= $contato['telefone'] ?></p>
              <p><i class="fas fa-map-marker-alt text-danger mr-2"></i><strong>Endereço:</strong><br>
                <?= $contato['endereco'] ?>
              </p>
              <p><i class="fas fa-clock text-danger mr-2"></i><strong>Horário:</strong><br> <?= $contato['horario'] ?></p>
              <p><i class="fab fa-instagram text-danger mr-2"></i><strong>Instagram:</strong><br>
                <a href="<?= $contato['insta_link'] ?>" target="_blank"><?= $contato['instagram'] ?></a>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
