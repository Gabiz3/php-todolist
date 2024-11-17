<?php

require_once __DIR__ . '/../controller/TarefaController.php';

$controller = new TarefaController();
$tarefas = $controller->listar();

if ($tarefas === null || !is_array($tarefas)) {
    $tarefas = []; 
}

if(isset($_GET['acao']) && $_GET['acao'] == 'remover' && isset($_GET['id'])) {
	$controller = new TarefaController();
	$controller -> excluir($_GET['id']);
}

if(isset($_GET['acao']) && $_GET['acao'] == 'editar' && isset($_GET['id'])) {
	header('Location: http://localhost/app_lista_tarefas_2/public/editar_tarefa.php?id=' . $_GET['id']);
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Lista Tarefas</title>
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
            <div class="col-sm-3 menu">
                <ul class="list-group">
                    <li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
                    <li class="list-group-item active"><a href="#">Todas tarefas</a></li>
                </ul>
            </div>

            <div class="col-sm-9">
		    <script>
				function remover(id) {
            		if (confirm('Deseja excluir?')) {
                		fetch('http://localhost/app_lista_tarefas_2/public/todas_tarefas.php?acao=remover&id=' + id)
                    		.then(response => response.json())
                    		.then(data => {
                        		if (data.status === 'success') {
                            		location.reload();
                        		} else {
                            		alert('Erro ao excluir a tarefa');
                        		}
                    		}).catch(error => {alert('Erro ao tentar excluir a tarefa');});
						}
       				 }
    		</script>

                <div class="container pagina">
                    <div class="row">
                        <div class="col">
                            <h4>Todas tarefas</h4>
                            <hr />

                            <?php if (count($tarefas) > 0): ?>
                                <?php foreach ($tarefas as $tarefa): ?>
                                    <div class="row mb-3 d-flex align-items-center tarefa">
                                        <div class="col-sm-9"><?= $tarefa['tarefa'] ?> (<?= $tarefa['id_status'] == 1 ? 'Ativa' : 'Concluída' ?>)</div>
                                        <div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa['id']?>)"></i>
										<a href="todas_tarefas.php?acao=editar&id=<?= $tarefa['id'] ?>">
        								<i class="fas fa-edit fa-lg text-info"></i></a>
                                            <i class="fas fa-check-square fa-lg text-success"></i>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nenhuma tarefa cadastrada.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>