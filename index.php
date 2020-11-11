<?php

require_once("classes/Sql.php");
$sql = new Sql();
$cadastros = $sql->listAll();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id){
    $sql->deleteData($id);
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sistema - Cadastro de Endereço</title>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
<body>
    <header>
    <nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="/">Listar Clientes</a></li>
        <li><a href="/form.php">Cadastrar Cliente</a></li>
      </ul>
    </div>
    
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="/">Listar Clientes</a></li>
    <li><a href="/form.php">Cadastrar Cliente</a></li>
  </ul>
    </header>
    <div class="container">
        <h3>Lista de Clientes</h3>
        <ul class="collapsible popout">
            <?php 
            if($cadastros){
                foreach($cadastros as $cadastro){ ?>
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons">portrait</i>
                        <p><?php echo $cadastro['first_name']. " ". $cadastro['last_name']; ?></p>
                    </div>
                    <div class="collapsible-body">
                        <h4>Endereço</h4>
                        <p> <?php echo $cadastro['logradouro'] ??"Não Informado";?></p>
                        <p>Numero: <?php echo $cadastro['number'] ??"Não Informado";?></p>
                        <p>Complemento: <?php echo $cadastro['complement'] ??"Não Informado";?></p>
                        <p>Bairro: <?php echo $cadastro['neighborhood']??"Não Informado";?></p>
                        <p>Cidade: <?php echo $cadastro['city']??"Não Informado";?></p>
                        <p>Estado: <?php echo $cadastro['state']??"Não Informado";?></p>
                        <div class="container buttons">    
                            <a class="btn-floating blue" href="form.php?id=<?php echo $cadastro['id']; ?>">
                                <i class="material-icons">edit</i>
                            </a>
                            <a class="btn-floating red" href="/?id=<?php echo $cadastro['id']; ?>">
                                <i class="material-icons">delete_forever</i>
                            </a>
                        </div>
                    </div>
                </li>
            <?php
                }
            } else { ?>
                <li>
                    <div class="collapsible-header">
                        <i class="material-icons"></i>
                        <p>Nenhum cliente Cadastrado no momento</p>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--JavaScript at end of body for optimized loading-->
<script src="/assets/lib/jquery-3.5.1.min.js"></script>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="/assets/js/script.js"></script>
</body>

</html>