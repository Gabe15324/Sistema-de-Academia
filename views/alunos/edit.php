<?php
require '../../config/db.php';
session_start();
$conn = Database::conectar();
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$aluno = $stmt->fetch();

if (!$aluno) {
    echo "Aluno não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE usuarios SET nome=?, cpf=?, data_nascimento=?, telefone=?, endereco=? WHERE id=?");
    $stmt->execute([
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['data_nascimento'],
        $_POST['telefone'],
        $_POST['endereco'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Editar Aluno</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" novalidate>
                            <div class="form-group">
                                <label for="nome">Nome <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="nome" 
                                    name="nome" 
                                    class="form-control" 
                                    value="<?= htmlspecialchars($aluno['nome']) ?>" 
                                    required 
                                    placeholder="Nome completo"
                                >
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    id="cpf" 
                                    name="cpf" 
                                    class="form-control" 
                                    value="<?= htmlspecialchars($aluno['cpf']) ?>" 
                                    required 
                                    placeholder="000.000.000-00"
                                >
                            </div>
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
                                <input 
                                    type="date" 
                                    id="data_nascimento" 
                                    name="data_nascimento" 
                                    class="form-control" 
                                    value="<?= htmlspecialchars($aluno['data_nascimento']) ?>" 
                                    required 
                                >
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input 
                                    type="text" 
                                    id="telefone" 
                                    name="telefone" 
                                    class="form-control" 
                                    value="<?= htmlspecialchars($aluno['telefone']) ?>" 
                                    placeholder="(00) 00000-0000"
                                >
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço</label>
                                <textarea 
                                    id="endereco" 
                                    name="endereco" 
                                    class="form-control" 
                                    rows="3" 
                                    placeholder="Endereço completo"
                                ><?= htmlspecialchars($aluno['endereco']) ?></textarea>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
