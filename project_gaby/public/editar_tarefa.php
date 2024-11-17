<?php
require_once __DIR__ . '/../controller/TarefaController.php';

$controller = new TarefaController();
$tarefa = null;

if (isset($_GET['id'])) {
    $tarefas = $controller->listar();
    foreach ($tarefas as $item) {
        if ($item['id'] == $_GET['id']) {
            $tarefa = $item;
            break;
        }
    }
}

if (!$tarefa) {
    header('Location: todas_tarefas.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="./assets/css/estilo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="./assets/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                App Lista Tarefas
            </a>
        </div>
    </nav>

    <div class="container app">
        <div class="row">
            <div class="col-md-3 menu">
                <ul class="list-group">
                    <li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
                    <li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
                    <li class="list-group-item active"><a href="todas_tarefas.php">Todas tarefas</a></li>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="container pagina">
                    <div class="row">
                        <div class="col">
                            <h4>Editar Tarefa</h4>
                            <hr />

                            <form action="../controller/TarefaController.php?acao=editar&id=<?= $tarefa['id'] ?>" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="tarefa">Descrição da Tarefa</label>
                                        <input type="text" class="form-control" id="tarefa" name="tarefa" value="<?= htmlspecialchars($tarefa['tarefa']) ?>" required>
                                    </div>
                                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
