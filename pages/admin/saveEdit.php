<?php
session_start();
include_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_GET['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nivel_acesso = $_POST['nivel_acesso'];

    $query = "UPDATE usuarios SET nome='$nome', email='$email', password='$password', nivel_acesso='$nivel_acesso' WHERE id='$id'";
    $result = mysqli_query($conexao, $query);

    if ($result) {
        header("Location: dash-adm.php");
        exit();
    } else {
        echo "<p>Erro ao atualizar os dados!</p>";
    }
}
