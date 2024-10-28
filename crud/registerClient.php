<?php
if(isset($_POST['submit'])) {
    include_once('connection.php');

    $name = $_POST['name'] . " " . $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $cep = $_POST['cep'];
    $mode = $_POST['mode'];
    $instructor = $_POST['instructor'];
    $data_nascimento = $_POST['birthdate'];


    $stmt = $connection->prepare("INSERT INTO register (name, email, address, state, cep, mode, instructor, birthdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    // Bind parameters (proteção)
    $stmt->bind_param("ssssssss", $name, $email, $address, $state, $cep, $mode, $instructor, $data_nascimento);

    if($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="checkout.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 960px;
        }
        .custom-container {
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
    <!-- Paginação -->
    <div class="container">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
              <li class="nav-item"><a href="home.php" class="nav-link">Home</a></li>
              <li class="nav-item"><a disabled class="nav-link active" aria-current="page">Cadastro</a></li>
              <li class="nav-item"><a href="view.php" class="nav-link">Alunos</a></li>
          </ul>
        </header>
    </div>
    <br><br><br>

    <!-- Campos para os dados do aluno -->
    <div class="row g-5 justify-content-center">
        <div class="col-md-7 col-lg-8 custom-container">
          <h4 class="mb-3">Dados do Aluno</h4>
          <form id="cadastroForm" class="needs-validation" novalidate method="post">

            <div class="row g-3">
               <!-- Nome -->
              <div class="col-sm-6">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Nome é obrigatório.
                </div>
              </div>

              <!-- Sobrenome -->
              <div class="col-sm-6">
                <label for="lastName" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Sobrenome é obrigatório.
                </div>
              </div>

              <!-- Email -->
              <div class="col-12">
                <label class="form-label">Email <span class="text-body-secondary"></span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
                <div class="invalid-feedback">
                  Por favor, insira um endereço de email válido.
                </div>
              </div>

              <!-- Endereço -->
              <div class="col-12">
                <label for="address" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                  Endereço é obrigatório.
                </div>
              </div>

              <!-- Estado -->
              <div class="col-md-4">
                <label for="state" class="form-label">Estado</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="" required>
                <div class="invalid-feedback">
                  Por favor, selecione um estado válido.
                </div>
              </div>

              <!-- CEP -->
              <div class="col-md-3">
                  <label for="zip" class="form-label">CEP</label>
                  <input type="text" class="form-control" id="cep" name="cep" placeholder="" required>
                  <div class="invalid-feedback">
                    CEP é obrigatório.
                  </div>
                </div>
              </div>
            
              <!-- Modalidade -->
              <div class="my-3">
                <label for="mode" class="form-label">Modalidade</label>
                <div class="form-check">
                    <input id="musculação" value="Musculação" type="radio" class="form-check-input" name="mode" required>
                    <label class="form-check-label">Musculação</label>
                </div>
                <div class="form-check">
                    <input id="jiujitsu" value="Jiu-jítsu" type="radio" class="form-check-input" name="mode" required>
                    <label class="form-check-label" for="jiujitsu">Jiu-jítsu</label>
                </div>
                <div class="form-check">
                    <input id="zumba" value="ZUMBA" type="radio" class="form-check-input" name="mode" required>
                    <label class="form-check-label" for="zumba">Aula de ZUMBA</label>
                </div>
            </div>

            <!-- Instrutor -->
            <div class="row gy-3">
                <div class="col-md-6">
                    <label for="instructor" class="form-label">Instrutor</label>
                    <select class="form-select" name="instructor" required>
                        <option value="">Escolha...</option>
                        <option value="Paulo Roberto">Paulo Roberto</option>
                        <option value="Luiza Souza">Luiza Souza</option>
                    </select>
                    <div class="invalid-feedback">
                        Instrutor é obrigatório.
                    </div>
                </div>
            </div>

            <!-- Data de nascimento -->
            <div class="col-md-6">
              <label for="cc-number" class="form-label">Data de nascimento</label>
              <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="xx/xx/xxxx" required>
              <div class="invalid-feedback">
              Data de nascimento é obrigatório.
              </div>
            </div>

            <!-- button Cadastrar -->
            <hr class="my-4">
            <button type="submit" name="submit" class="btn btn-primary btn-lg rounded-pill shadow">Cadastrar</button>
            
          </div>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3iGmY5i5n0I5r5V7mD8Y5y5t5Y5t" crossorigin="anonymous"></script>
    <script>
      (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
              }
              form.classList.add('was-validated')
            }, false)
          })
      })()
    </script>
  </body>
</html>