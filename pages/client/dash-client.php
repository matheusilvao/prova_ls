<?php
session_start();
if (
  !isset($_SESSION["email"]) == true &&
  !isset($_SESSION["password"]) == true
) {
  unset($_SESSION["email"]);
  unset($_SESSION["password"]);
  header("Location: ../login.php");
}

$userLogado = $_SESSION["email"];
include_once "../../connect.php";

$queryNameUser = "SELECT nome FROM usuarios WHERE email = '$userLogado'";
$resultNameUser = mysqli_query($conexao, $queryNameUser);

if ($resultNameUser) {
  if (mysqli_num_rows($resultNameUser) > 0) {
    $row = mysqli_fetch_assoc($resultNameUser);
    $nameUser = $row["nome"];

    $query = "SELECT * FROM usuarios";
    $result = mysqli_query($conexao, $query);

    $users = [];

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
      }
    }
  } else {
    header("Location: ../login.php");
    exit();
  }
} else {
  echo "Erro ao obter o nome do usuário: " . mysqli_error($conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listagem de Usuários</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" href="../../css/client.css">
</head>

<body>
  <header class="header-container">
    <h1>Tela cliente / <?php echo $nameUser; ?>!</h1>
    <button>
      <a href="../../logout.php">Sair</a>
    </button>
  </header>
  <main class="main-container">
    <h2 class="section-title">Listagem de Usuários</h2>
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Nível de Acesso</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user) {
          $nivel_acesso =
            $user["nivel_acesso"] == 1 ? "Administrador" : "Cliente";
          echo "<tr>";
          echo "<td>" . $user["id"] . "</td>";
          echo "<td>" . $user["nome"] . "</td>";
          echo "<td>" . $user["email"] . "</td>";
          echo "<td>" . $nivel_acesso . "</td>";
          echo "</tr>";
        } ?>
      </tbody>
    </table>
  </main>
</body>

</html>
