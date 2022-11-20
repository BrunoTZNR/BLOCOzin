<?php
session_start();
$modo = 'producao';

if ($modo == 'teste') {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'blocozin';
} else {
    $host = 'db4free.net';
    $user = 'brunotznr_0369';
    $pass = "Mysql@0369";
    $dbname = 'blocozin_0369';
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo 'DEU BOM!';
} catch (PDOException $e) {
    echo 'ERROR: deu merda ae -> ' . $e->getMessage();
}

// MÉTODO RESPONSÁVEL POR LIMPAR OS CAMPOS INPUT
function clean($dado)
{
    $dado = trim($dado);
    $dado = stripslashes($dado);
    $dado = htmlspecialchars($dado);
    return $dado;
}

// MÉTODO RESPONSÁVEL POR INFERIR A MENSAGEM DE ALERT NA PAGINA DE LOGIN
function alertLogin($alert)
{
    switch ($alert) {
        case 'sucess':
            return '<p>Usuário criado com sucesso!</p>';
            break;
        case 'falid':
            return '<p>Email e/ou senha estão incorretos!</p>';
            break;
        case 'delete':
            return '<p>Usuário deletado com sucesso!</p>';
            break;
        case 'null':
            return '<p>Todos os campos são obrigatórios</p>';
            break;
        default:
            return '<p>Burla não em!</p>';
            break;
    }
}

// MÉTODO RESPONSÁVEL POR INFERIR A MENSAGEM DE ALERT NA PAGINA DE LISTAGEM
function alertListagem($alert)
{
    switch ($alert) {
        case 'null':
            return '<p>Nenhuma nota encontrada!</p>';
            break;

        case 'delete':
            return '<p>Nota deletada com sucesso!</p>';
            break;

        default:
            return '<p>Já falei pra nao burlar!</p>';
            break;
    }
}

// MÉTODO RESPONSÁVEL POR INFERIR A MENSAGEM DE ALERT NA PAGINA DE VIEW
function alertView($alert)
{
    switch ($alert) {
        case 'insert':
            return '<p>Nota criada com sucesso!</p>';
            break;

        case 'update':
            return '<p>Nota alterada com sucesso!</p>';
            break;

        default:
            return '<p>Já falei pra nao burlar!</p>';
            break;
    }
}
