<?php
require_once 'artigo.php';
$artigo = new Artigo("UFBNA", "localhost", "root", "123456");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form UFBNA</title>
    <link rel="stylesheet" href="./style/userControl.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/main.css">
</head>

<body>
    <div class="esquerda">
        <form method="POST" action="formArtigo.php">
            <?php
            // Array de informações para cada entrada
            $inputs = array(
                'titulo' => 'Título',
                'resumo' => 'Resumo',
                'texto' => 'Texto',
                'data' => 'Data',
                'areaConhecimento' => 'Área de Conhecimento',
            );

            // Loop para gerar campos de entrada
            foreach ($inputs as $name => $label) {
                echo '<input type="text" name="' . $name . '" placeholder="' . $label . '" value="' . (isset($_GET[$name]) ? htmlspecialchars($_GET[$name]) : '') . '"><br>';
            }
            ?>

            <input type="hidden" name="id_up" value="<?php if (isset($_GET["id_up"])) {
                                                            echo $_GET['id_up'];
                                                        } ?>">
            <input type="submit" value="Enviar">
        </form>

        <div class="relatorio form-control">
            <?php

            ?>

            <h2>relatório</h2>
            <p>Total de Artigos: <?php echo "<strong>" . $artigo->totalArtigos() . "</strong>" ?> </p>
            <p>Área mais publicada:
                <?php
                $areasMaisCitadas = $artigo->AreaMaisCitada();
                foreach ($areasMaisCitadas as $label => $value) {
                    if ($label == "AreaConhecimento") {
                        echo "<strong>" . $value . "</strong> - ";
                    } else {
                        echo "<strong>" . $value . "</strong>";
                    }
                }
                ?>
            </p>

        </div>
    </div>

    <div class="direita">

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><input type="checkbox" id="select-all"></th>
                    <th cope="col">titulo</th>
                    <th cope="col">resumo</th>
                    <th cope="col">texto</th>
                    <th cope="col">dataRecepcao</th>
                    <th cope="col">areaConhecimento</th>
                </tr>
            </thead>
            <tbody>
                <form id="bulk-delete-form">
                    <?php
                    $artigos = $artigo->consultarArtigo();

                    if (count($artigos) > 0) {
                        foreach ($artigos as $artg) {
                            echo "<tr>";
                            echo '<td><input type="checkbox" name="ids[]" value="' . $artg['ArtigoID'] . '"></td>';
                            echo '<td>' . $artg['TituloArtigo'] . '</td>';
                            echo '<td>' . $artg['ResumoArtigo'] . '</td>';
                            echo '<td>' . $artg['TextoArtigo'] . '</td>';
                            echo '<td>' . $artg['DataRecepcao'] . '</td>';
                            echo '<td>' . $artg['AreaConhecimento'] . '</td>';
                            echo '<td>';
                            echo '<a href="#" onclick="excluirArtigo(' . $artg['ArtigoID'] . ', \'' . ($artg['TituloArtigo']) . '\')">Excluir</a>';
                            echo ' | ';
                            echo '<a href="formArtigo.php?id_up=' . $artg['ArtigoID'] . '&titulo=' . urlencode($artg['TituloArtigo']) . '&resumo=' . urlencode($artg['ResumoArtigo']) . '&texto=' . urlencode($artg['TextoArtigo']) . '&data=' . urlencode($artg['DataRecepcao']) . '&areaConhecimento=' . urlencode($artg['AreaConhecimento']) . '">Editar</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='8'>Ainda não há artigos cadastrados!</td></tr>";
                    }


                    ?>
                </form>
            </tbody>
        </table>
        <button class="btn btn-danger">Excluir Selecionados</button>

    </div>

    <script type="text/javascript">
        function validarCampoVazio(event) {
            const nome = document.getElementById('input-name').value;
            const email = document.getElementById('input-email').value;
            if (!nome || !email) {
                alert("Por favor, preencha todos os campos.");
                event.preventDefault();
            }
        }


        function validarCheckbox(event) {
            const checkboxes = document.querySelectorAll('input[name="ids[]"]:checked');
            if (checkboxes.length === 0) {
                alert("Por favor, selecione pelo menos um registro para excluir.");
                event.preventDefault();
            } else {
                excluirEmMassa();
            }


        }

        document.addEventListener("DOMContentLoaded", function() {
            const primeiroFormulario = document.querySelector('.form-control');
            primeiroFormulario.addEventListener('submit', validarCampoVazio);

            const botaoExcluir = document.querySelector('.btn.btn-danger');
            botaoExcluir.addEventListener('click', validarCheckbox);
        });

        // ------------------SCRIPT DE EXCLUSÃO----------------------
        function excluirArtigo(id, titulo) {
            if (confirm('Quer mesmo EXCLUIR ' + titulo + '?')) {
                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'formArtigo.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            window.location.href = 'formArtigo.php';
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
                xhr.open('POST', 'formArtigo.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            window.location.href = 'formArtigo.php';
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

// ------------------EXCLUIR----------------------
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['idEx'])) {
    $id = $_POST['idEx'];

    if (!empty($id)) {
        $artigo->excluirArtigo($id);
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
            $artigo->excluirArtigo($id);
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
        $titulo = addslashes($_POST['titulo']);
        $resumo = addslashes($_POST['resumo']);
        $texto = addslashes($_POST['texto']);
        $data = addslashes($_POST['data']);
        $areaConhecimento = addslashes($_POST['areaConhecimento']);


        if (!empty($titulo) && !empty($areaConhecimento)) {
            $artigo->editarArtigo($id_up, $titulo, $resumo, $texto, $data, $areaConhecimento);

            echo "
                <script type='text/javascript'>
                    window.location.href = 'formArtigo.php';
                </script>
            ";
        } else {
            echo "Preencha todos os campos";
        }
    } elseif (isset($_POST['titulo']) && !empty($_POST['areaConhecimento'])) {
        // ---------------INSERIR NOVO REGISTRO ------------------
        $titulo = addslashes($_POST['titulo']);
        $resumo = addslashes($_POST['resumo']);
        $texto = addslashes($_POST['texto']);
        $data = addslashes($_POST['data']);
        $areaConhecimento = addslashes($_POST['areaConhecimento']);


        if (!empty($titulo) && !empty($areaConhecimento)) {
            $artigo->inserirArtigo($titulo, $resumo, $texto, $data, $areaConhecimento);
            echo "
                        <script type='text/javascript'>
                                window.location.href = 'formArtigo.php';
                            </script>
                        ";
        } else {
            echo "Preencha todos os campos";
        }
    }
}

?>