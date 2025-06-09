<?php
require '../../config/db.php';

session_start();
$conn = Database::conectar();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO alunos (nome, cpf, data_nascimento, telefone, endereco) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nome'],
        $_POST['cpf'],
        $_POST['data_nascimento'],
        $_POST['telefone'],
        $_POST['endereco']
    ]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Novo Aluno - Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card shadow-sm w-100" style="max-width: 600px;">
            <div class="card-header bg-success text-white text-center">
                <h3 class="mb-0">Cadastrar Novo Aluno</h3>
            </div>
            <div class="card-body">
                <form id="formAluno" method="POST" novalidate>
                    <div class="form-group">
                        <label for="nome">Nome <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            id="nome" 
                            name="nome" 
                            class="form-control" 
                            placeholder="Nome completo" 
                            required 
                        />
                        <div class="invalid-feedback">Por favor, insira o nome.</div>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF <span class="text-danger" >*</span></label>
                        <input 
                            type="text" 
                            id="cpf" 
                            name="cpf" 
                            class="form-control" 
                            placeholder="000.000.000-00" 
                            required 
                        />
                        <div class="invalid-feedback">CPF inválido.</div>
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento <span class="text-danger">*</span></label>
                        <input 
                            type="date" 
                            id="data_nascimento" 
                            name="data_nascimento" 
                            class="form-control" 
                            required 
                        />
                        <div class="invalid-feedback">Data de nascimento inválida.</div>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input 
                            type="text" 
                            id="telefone" 
                            name="telefone" 
                            class="form-control" 
                            placeholder="(00) 00000-0000" 
                        />
                        <div class="invalid-feedback">Telefone inválido.</div>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <textarea 
                            id="endereco" 
                            name="endereco" 
                            class="form-control" 
                            placeholder="Endereço completo" 
                            rows="3"
                        ></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
// Função para validar CPF
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false;
    // Elimina CPFs inválidos conhecidos
    if (cpf.length != 11 || 
        cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" ||
        cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" ||
        cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" ||
        cpf == "99999999999")
        return false;
    // Validação do primeiro dígito verificador
    let soma = 0;
    for (let i=0; i < 9; i++)
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    let resto = 11 - (soma % 11);
    if (resto == 10 || resto == 11)
        resto = 0;
    if (resto != parseInt(cpf.charAt(9)))
        return false;
    // Validação do segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++)
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    resto = 11 - (soma % 11);
    if (resto == 10 || resto == 11)
        resto = 0;
    if (resto != parseInt(cpf.charAt(10)))
        return false;
    return true;
}

// Função para validar telefone (opcional, aceita 10 ou 11 dígitos, com ou sem máscara)
function validarTelefone(tel) {
    if (tel.trim() === '') return true; // campo opcional
    tel = tel.replace(/[^\d]+/g,'');
    return tel.length === 10 || tel.length === 11;
}

// Valida data de nascimento (não pode ser futura e não pode ser muito antiga)
function validarDataNascimento(data) {
    if (!data) return false;
    const hoje = new Date();
    const dt = new Date(data);
    if (dt > hoje) return false;
    // Limitar a idade máxima, por exemplo 120 anos
    const idade = hoje.getFullYear() - dt.getFullYear();
    if (idade > 120) return false;
    return true;
}

document.getElementById('formAluno').addEventListener('submit', function(event) {
    const form = this;
    let valido = true;

    // Nome
    const nome = form.nome;
    if (!nome.value.trim()) {
        nome.classList.add('is-invalid');
        valido = false;
    } else {
        nome.classList.remove('is-invalid');
    }

    // CPF
    const cpf = form.cpf;
    if (!validarCPF(cpf.value)) {
        cpf.classList.add('is-invalid');
        valido = false;
    } else {
        cpf.classList.remove('is-invalid');
    }

    // Data Nascimento
    const dataNascimento = form.data_nascimento;
    if (!validarDataNascimento(dataNascimento.value)) {
        dataNascimento.classList.add('is-invalid');
        valido = false;
    } else {
        dataNascimento.classList.remove('is-invalid');
    }

    // Telefone
    const telefone = form.telefone;
    if (!validarTelefone(telefone.value)) {
        telefone.classList.add('is-invalid');
        valido = false;
    } else {
        telefone.classList.remove('is-invalid');
    }

    if (!valido) {
        event.preventDefault();
        event.stopPropagation();
    }
});
</script>
</body>
</html>

