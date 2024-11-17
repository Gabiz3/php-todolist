<?php 
require_once __DIR__ . '/../model/Tarefa.php';
require_once __DIR__ . '/../service/TarefaService.php';
require_once __DIR__ . '/../db/Conexao.php';

// ANOTAÇÃO: usa daquela forma os imports assim na controller pois não vai dar aquela dor de cabeça de novo
// o require_once __DIR__ serve pra achar o diretório /.. (significa 2 niveis dentro da pasta root do projeto)

class TarefaController {

    public function inserir() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tarefa = new Tarefa();
            $tarefa->__set('tarefa', $_POST['tarefa']);
            $tarefa->__set('id_status', 1); // inicia o status como 1 (ativo)


            $conexao = new Conexao();
            $tarefaService = new TarefaService($conexao, $tarefa);
            $tarefaService->inserir();

            
            header('Location: http://localhost/app_lista_tarefas_2/public/nova_tarefa.php');
            exit;
        }
    }

    public function listar() {
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao);
        $tarefas = $tarefaService-> listar();
        return $tarefas;
    }

    public function excluir($id) {
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao);
        $tarefaService -> deletar($id);

        echo json_encode(['status' => 'success']);
        exit;
    }

    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tarefa = new Tarefa();
            $tarefa->__set('id', $id);
            $tarefa->__set('tarefa', $_POST['tarefa']);
    
            $conexao = new Conexao();
            $tarefaService = new TarefaService($conexao, $tarefa);
            $tarefaService->atualizar();
            
            header('Location: http://localhost/app_lista_tarefas_2/public/todas_tarefas.php');
            exit;
        }
    }
    

}

if (isset($_GET['acao']) && $_GET['acao'] === 'editar' && isset($_GET['id'])) {
    $controller = new TarefaController();  
    $controller->editar($_GET['id']); 
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $controller = new TarefaController();
    $controller->inserir();  
}
?>