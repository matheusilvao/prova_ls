<?php
session_start();
include_once "../../connect.php";

if (!empty($_GET["id"])) {
  $id = $_GET["id"];

  // Consulta ao banco de dados para obter os dados do usuário com o ID fornecido
  $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
  $result = $conexao->query($sqlSelect);

  // Verifica se encontrou algum registro
  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $nome = $row["nome"];
      $email = $row["email"];
      $password = $row["password"];
      $nivel_acesso = $row["nivel_acesso"];
    }
  } else {
    // Se não encontrou nenhum registro, redireciona de volta para a página admin.php
    header("Location: dash-adm.php");
    exit();
  }
} else {
  // Se não foi fornecido nenhum ID, redireciona de volta para a página admin.php
  header("Location: dash-adm.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Produto</title>
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

.user-form .input-field,
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
      <h2>Editar Usuário</h2>
    </div>
    <form class="user-form" action="saveEdit.php?id=<?php echo $id; ?>" method="post">
      <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="nome" class="input-field" placeholder="Nome" required value="<?php echo htmlspecialchars($nome); ?>">
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" class="input-field" placeholder="E-mail" required value="<?php echo htmlspecialchars($email); ?>">
      </div>
      <div class="form-group">
        <label for="password">Senha:</label>
        <input type="text" id="password" name="password" class="input-field" placeholder="Senha" required value="<?php echo htmlspecialchars($password); ?>">     
      </div>
      <div class="form-group">
        <label for="role">Nível de Acesso:</label>
        <select name="nivel_acesso" id="role" required>
          <option value="2" <?php echo $nivel_acesso == 2 ? "selected" : ""; ?>>Cliente</option>
          <option value="1" <?php echo $nivel_acesso == 1 ? "selected" : ""; ?>>Admin</option>
        </select>
      </div>

      <div class="form-group">
        <button type="submit" class="submit-button">Salvar</button>
      </div>
    </form>
  </div>
</body>


</html>