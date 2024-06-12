<?php
require_once 'autor_class.php';
$aluno = new Aluno("UFBNA", "localhost", "root", "123456");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form UFBNA</title>
    <link rel="stylesheet" href="./style/userControl.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <main>
        
        <div class="esquerda">
            <form action="form.php" method="POST" class="form-control">
                <div class="input-group mb-3">
                    <input id="input-name" name="name" type="text" class="form-control" placeholder="Nome" value="<?php if (isset($_GET["id_up"])) {
                                                                                                                        echo $_GET['nome'];
                                                                                                                    } ?>">
                </div>
                <div class="input-group mb-3">
                    <input id="input-email" name="email" type="email" class="form-control" placeholder="Email" value="<?php if (isset($_GET["id_up"])) {
                                                                                                                            echo $_GET['email'];
                                                                                                                        } ?>">
                </div>
                <input type="hidden" name="id_up" value="<?php if (isset($_GET["id_up"])) {
                                                                echo $_GET['id_up'];
                                                            } ?>">
                <input class="btn btn-primary" type="submit" value="enviar">
            </form>

            <div class="relatorio form-control">
                <h2>relatório</h2>
                <p>Total de Autores: <?php echo "<strong>". $aluno->totalAlunos(). "</strong>" ?> </p>
            </div>
        </div>

        <div class="direita">
            <table class="table table-striped table-hover">
                <thead>
                    <tr id="titulo">
                        <th scope="col"><input type="checkbox" id="select-all"></th>
                        <th scope="col">id</th>
                        <th scope="col">nome</th>
                        <th scope="col">email</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <form id="bulk-delete-form">
                        <?php
                        $dados = $aluno->consultarAluno();
                        if (count($dados) > 0) {
                            for ($i = 0; $i < count($dados); $i++) {
                                echo "<tr>";
                                echo '<td><input type="checkbox" name="ids[]" value="' . $dados[$i]['AutorID'] . '"></td>';
                                foreach ($dados[$i] as $k => $v) {
                                    echo "<td>" . ($v) . "</td>";
                                }
                                echo '<td>';
                                echo '<a href="#" onclick="excluirAluno(' . ($dados[$i]['AutorID']) . ', \'' . ($dados[$i]['NomeAutor']) . '\')">Excluir</a>';
                                echo '</td>';
                                echo '<td>';
                                echo '<a href="form.php?id_up=' . $dados[$i]['AutorID'] . '&nome=' . $dados[$i]['NomeAutor'] . '&email=' . $dados[$i]['EmailAutor'] . '">Editar</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo "Ainda não há pessoas cadastradas!";
                        }
                        ?>
                    </form>
                </tbody>
            </table>
            <button class="btn btn-danger">Excluir Selecionados</button>


        </div>
    </main>

    <script type="text/javascript">
        // Função de validação para o primeiro formulário
        function validarCampoVazio(event) {
            const nome = document.getElementById('input-name').value;
            const email = document.getElementById('input-email').value;
            if (!nome || !email) {
                alert("Por favor, preencha todos os campos.");
                event.preventDefault(); // Previne o envio do formulário
            }
        }


        function validarCheckbox(event) {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
            if (checkboxes.length === 0) {
                alert("Por favor, selecione pelo menos um registro para excluir.");
                event.preventDefault(); // Previne o envio do formulário
            } else {
                excluirEmMassa();
            }


        }

        document.addEventListener("DOMContentLoaded", function() {
            // validação no formulário 
            const primeiroFormulario = document.querySelector('.form-control');
            primeiroFormulario.addEventListener('submit', validarCampoVazio);

            // validação no botão de exclusão em massa
            const botaoExcluir = document.querySelector('.btn.btn-danger');
            botaoExcluir.addEventListener('click', validarCheckbox);
        });

        // ------------------SCRIPT DE EXCLUSÃO----------------------
        function excluirAluno(id, nome) {
            if (confirm('Quer mesmo EXCLUIR ' + nome + '?')) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'form.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            window.location.href = 'form.php';
                        } else {
                            console.error('Erro ao excluir aluno');
                        }
                    }
                };
                xhr.send('idEx=' + id);
            }
        }

        function excluirEmMassa() {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
            let ids = [];
            checkboxes.forEach(checkbox => {
                ids.push(checkbox.value);
            });

            if (confirm('Quer mesmo EXCLUIR ' + checkboxes.length + ' registros?')) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'form.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            window.location.href = 'form.php';
                        } else {
                            console.error('Erro ao excluir aluno');
                        }
                    }
                };
                xhr.send('ids=' + JSON.stringify(ids));

            }
        }


        document.getElementById('select-all').addEventListener('click', toggleCheckboxes);

        document.getElementById('select-all').addEventListener('keypress', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                toggleCheckboxes.call(this);
            }
        });

        function toggleCheckboxes() {
            let checkboxes = document.querySelectorAll('input[name="ids[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>


</body>

</html>


<?php
require_once('./autor_class.php');

// ------------------EXCLUIR----------------------
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['idEx'])) {
    $id = $_POST['idEx'];

    if (!empty($id)) {
        $aluno->excluirAluno($id);
        echo "Aluno excluído com sucesso";
    } else {
        echo "Erro: ID do aluno não fornecido.";
    }
}


// ---------------EXCLUIR EM MASSA ------------------
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['ids'])) {
    $ids = json_decode($_POST['ids'], true);

    if (!empty($ids)) {
        foreach ($ids as $id) {
            $aluno->excluirAluno($id);
        }
        echo "
            <script type='text/javascript'>
                window.location.href = 'form.php';
            </script>
        ";
    } else {
        echo "Nenhum registro selecionado para exclusão.";
    }
}



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['id_up']) && !empty($_POST['id_up'])) {
        // ---------------ATUALIZAR REGISTRO EXISTENTE------------------
        $id_up = addslashes($_POST['id_up']);
        $nome = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);

        if (!empty($nome) && !empty($email)) {
            $aluno->editarAluno($id_up, $nome, $email);
            echo "
                <script type='text/javascript'>
                    window.location.href = 'form.php';
                </script>
            ";
        } else {
            echo "Preencha todos os campos";
        }
    } elseif (isset($_POST['name']) && !empty($_POST['email'])) {
        // ---------------INSERIR NOVO REGISTRO ------------------
        $nome = addslashes($_POST['name']);
        $email = addslashes($_POST['email']);

        if (!empty($nome) && !empty($email)) {
            $aluno->inserirAluno($nome, $email);
            echo "
                <script type='text/javascript'>
                    window.location.href = 'form.php';
                </script>
            ";
        } else {
            echo "Preencha todos os campos";
        }
    }
}
?>