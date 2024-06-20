<?php
session_start();
include_once "../../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $nivel_acesso = $_POST["nivel_acesso"];

  $verifica_email = "SELECT * FROM usuarios WHERE email = '$email'";
  $result_validate = mysqli_query($conexao, $verifica_email);

  if (mysqli_num_rows($result_validate) > 0) {
    echo "<p class='temEmail' >EMAIL JA CADASTRADO!</p>";
  } else {
    $query = "INSERT INTO usuarios (nome, email, password, nivel_acesso) VALUES ('$nome', '$email', '$password', '$nivel_acesso')";
    $result = mysqli_query($conexao, $query);

    if ($result) {
      header("Location: dash-adm.php");
      exit();
    } else {
      echo "<p>Erro ao atualizar os dados!</p>";
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de usuários</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <style>

body {
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
  margin: 0;
  padding: 0;
}

.form-container {
  width: 100%;
  max-width: 400px;
  margin: 50px auto;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.form-header {
  text-align: center;
  margin-bottom: 20px;
}

.form-header h2 {
  font-size: 1.8em;
  color: #333;
}

.user-form .form-group {
  margin-bottom: 20px;
}

.user-form label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.user-form .input-field {
  width: 100%;
  padding: 10px;
  font-size: 1em;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.user-form select {
  width: 100%;
  padding: 10px;
  font-size: 1em;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.user-form .submit-button {
  width: 100%;
  padding: 10px;
  font-size: 1.2em;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.user-form .submit-button:hover {
  background-color: #45a049;
}

.user-form .submit-button:active {
  background-color: #3e8e41;
}

.user-form .submit-button:focus {
  outline: none;
}


  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-header">
      <h2>Adicionar Usuário</h2>
    </div>
    <form class="user-form" action="add.php" method="post">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="nome" class="input-field" placeholder="Nome" required>
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" class="input-field" placeholder="E-mail" required>
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="text" id="password" name="password" class="input-field" placeholder="Senha" required>
      </div>
      <div class="form-group">
        <label for="role">Nível de Acesso:</label>
        <select name="nivel_acesso" id="role" required>
          <option value="2">Cliente</option>
          <option value="1">Administrador</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="submit-button">Adicionar</button>
      </div>
    </form>
  </div>
</body>

</html>