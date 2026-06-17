<?php

require_once 'Pessoa.php';

$resultado = null;
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $dataNascimento = $_POST['data_nascimento'] ?? '';
    $peso = (float) ($_POST['peso'] ?? 0);
    $altura = (float) ($_POST['altura'] ?? 0);
    $fumante = ($_POST['fumante'] ?? 'nao') === 'sim';

    if ($nome === '' || $dataNascimento === '' || $peso <= 0 || $altura <= 0) {
        $erro = "Preencha todos os campos corretamente.";
    } else {
        $pessoa = new Pessoa($nome, $dataNascimento, $peso, $altura, $fumante);

        $resultado = [
            'nome' => $pessoa->getNome(),
            'idade' => $pessoa->calcularIdade(),
            'imc' => $pessoa->calcularIMC(),
            'classificacao' => $pessoa->classificarIMC(),
            'fumante' => $pessoa->isFumante() ? 'Sim' : 'Não',
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Calculadora de IMC e Idade</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        display: flex;
        justify-content: center;
        padding-top: 40px;
    }
    .container {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        width: 350px;
    }
    h1 {
        font-size: 20px;
        text-align: center;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
        font-size: 14px;
    }
    input[type="text"],
    input[type="date"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        margin-top: 4px;
        box-sizing: border-box;
    }
    .radio-group {
        margin-top: 6px;
    }
    button {
        width: 100%;
        margin-top: 20px;
        padding: 10px;
        background: #2d7a46;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background: #245f38;
    }
    .resultado {
        margin-top: 20px;
        background: #eef7ee;
        border: 1px solid #2d7a46;
        padding: 15px;
        border-radius: 6px;
    }
    .resultado p {
        margin: 6px 0;
    }
    .erro {
        margin-top: 15px;
        color: #a30000;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Calculadora de IMC e Idade</h1>

    <form method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>

        <label for="data_nascimento">Data de nascimento</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>

        <label for="peso">Peso (kg)</label>
        <input type="number" id="peso" name="peso" step="0.01" min="0" required>

        <label for="altura">Altura (m)</label>
        <input type="number" id="altura" name="altura" step="0.01" min="0" required>

        <label>Fumante?</label>
        <div class="radio-group">
            <input type="radio" id="fumante_sim" name="fumante" value="sim">
            <label for="fumante_sim" style="display:inline; font-weight:normal;">Sim</label>

            <input type="radio" id="fumante_nao" name="fumante" value="nao" checked style="margin-left:15px;">
            <label for="fumante_nao" style="display:inline; font-weight:normal;">Não</label>
        </div>

        <button type="submit">Calcular</button>
    </form>

    <?php if ($erro): ?>
        <p class="erro"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="resultado">
            <p><strong>Nome:</strong> <?= htmlspecialchars($resultado['nome']) ?></p>
            <p><strong>Idade:</strong> <?= $resultado['idade'] ?> anos</p>
            <p><strong>IMC:</strong> <?= $resultado['imc'] ?> (<?= $resultado['classificacao'] ?>)</p>
            <p><strong>Fumante:</strong> <?= $resultado['fumante'] ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
