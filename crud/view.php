<?php
// Conexão com o banco de dados
include_once('connection.php');

// Consulta para buscar os dados dos alunos
$query = "SELECT * FROM register";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lista de Alunos Cadastrados</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 960px;
        }
        .custom-container {
            border-radius: 10px;
            max-width: 900px;
            margin: 6 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .nav-pills .nav-link.active {
            background-color: #007bff;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="registerClient.php" class="nav-link">Cadastro</a></li>
                <li class="nav-item"><a disabled class="nav-link active" aria-current="page">Alunos</a></li>
            </ul>
            </div>
    </div>

    <div class="container mt-5">
        <div class="custom-container">
            <div class="mb-3">
                <input type="text" id="search" class="form-control search-input" placeholder="Pesquisar...">
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Instrutor</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody id="studentTable">
                    <?php
                        while($rows = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>".$rows['name']."</td>";
                            echo "<td>".$rows['email']."</td>";
                            echo "<td>".$rows['instructor']."</td>";
                            echo "<td>
                                    <button class='btn btn-sm btn-warning' onclick='editStudent(".$rows['id'].")'>
                                        <i class='bi bi-pencil'></i> Editar
                                    </button>
                                    <button class='btn btn-sm btn-danger' onclick='deleteStudent(".$rows['id'].")'>
                                        <i class='bi bi-trash'></i> Apagar
                                    </button>
                                  </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3iGmY5i5n0I5r5V7mD8Y5y5t5Y5t" crossorigin="anonymous"></script>
   
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const studentTable = document.getElementById('studentTable');

        searchInput.addEventListener('input', function() {
          const query = searchInput.value.toLowerCase();
          const rows = studentTable.getElementsByTagName('tr');
          for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;
            for (let j = 0; j < cells.length - 1; j++) {
              if (cells[j].innerText.toLowerCase().includes(query)) {
                match = true;
                break;
              }
            }
            rows[i].style.display = match ? '' : 'none';
          }
        });
      });

      function editStudent(id) {
        // Implementar lógica de edição
        alert(`Editar aluno com ID: ${id}`);
      }

      function deleteStudent(id) {
        if (confirm('Tem certeza que deseja apagar este aluno?')) {
          // Implementar lógica de exclusão
          alert(`Apagar aluno com ID: ${id}`);
        }
      }
    </script>
</body>
</html>