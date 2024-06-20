<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $nivel_acesso = 2;
  include_once "../connect.php";
  $verifica_email = "SELECT * FROM usuarios WHERE email = '$email'";
  $result_validate = mysqli_query($conexao, $verifica_email);

  if (mysqli_num_rows($result_validate) > 0) {
    echo "<p>Este email já foi cadastrado!!</p>";
  } else {
    $query = "INSERT INTO usuarios (nome, email, password, nivel_acesso) VALUES ('$nome', '$email', '$password', '$nivel_acesso')";
    $result = mysqli_query($conexao, $query);

    if ($result) {
      header("Location: login.php");
      exit();
    } else {
      echo "Error ao adicionar usuario";
    }
  }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../css/cadastro.css">
</head>

<body>
  <div class="form-container">
    <div class="form-header">
      <h2>Cadastro</h2>
    </div>
    <form class="registration-form" action="cadastro.php" method="post">
      <input type="text" name="nome" class="input-field" placeholder="Nome completo" required>
      <input type="email" name="email" class="input-field" placeholder="E-mail" required>
      <input type="password" name="password" class="input-field" placeholder="Senha" required>

      <input type="submit" value="Cadastrar" class="submit-button">
      <p>
        Já tem conta ?
        <a href="login.php">Login</a>
      </p>
    </form>
  </div>
</body>

</html>