<?php
session_start();

if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
  header("Location: ../login.php");
  exit();
}

$userLogado = $_SESSION["email"];
include_once "../../connect.php";

$queryNameUser = "SELECT nome FROM usuarios WHERE email = '$userLogado'";
$resultNameUser = mysqli_query($conexao, $queryNameUser);

if ($resultNameUser) {
  if (mysqli_num_rows($resultNameUser) > 0) {
    $row = mysqli_fetch_assoc($resultNameUser);
    $nameUser = $row["nome"];
  } else {
    header("Location: ../login.php");
    exit();
  }
} else {
  echo "Erro ao obter o nome do usuário: " . mysqli_error($conexao);
}

$query = "SELECT * FROM usuarios ORDER BY id DESC";
$result = mysqli_query($conexao, $query);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="../../css/adm.css">
</head>

<body>
  <header class="header-container">
    <h1>Tabela de Usuários | <?php echo $nameUser ?></h1>
    <button class="logout-button">
      <a href="../../logout.php">Sair</a>
    </button>
  </header>

  <div class="main-container">
    <div class="table-container">
      <table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
            <th>Nível de Acesso</th>
            <th>Opções</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) {
            $nivel_acesso =
              $row["nivel_acesso"] == 1 ? "Administrador" : "Cliente";
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nome"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $nivel_acesso . "</td>";
            echo "<td>
                      <button class='btn btn-edit'>
                        <a href='edit.php?id=$row[id]'>
                          <span class='material-icons-outlined'>
                            edit
                          </span>
                        </a>
                      </button>
                      <button class='btn btn-delete'>
                        <a href='delete.php?id=$row[id]'>
                          <span class='material-icons-outlined'>
                            delete
                          </span>
                        </a>
                      </button>
                    </td>";
            echo "</tr>";
          } ?>
        </tbody>
      </table>
    </div>

    <div class="add-button">
      <h3>Adicionar Usuário</h3>
      <button class="btn btn-add">
        <a href="add.php">
          <span class='material-icons-outlined'>
            add
          </span>
        </a>
      </button>
    </div>
  </div>
</body>

</html>
