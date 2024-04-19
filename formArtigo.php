<?php
require_once 'artigo.php';
$artigo = new Artigo("UFBNA", "localhost", "root", "Bagriel#2006");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form UFBNA</title>
    <link rel="stylesheet" href="./style/main.css">
</head>

<body>

    <div class="esquerda">
        <form action="formArtigo.php" method="post">
            <input type="text" name="titulo">
            <input type="text" name="resumo">
            <input type="text" name="texto">
            <input type="text" name="data">
            <input type="text" name="areaConhecimento">
            <input type="number" name="nota">
            <input type="autores" name="autores">
            <input type="submit" value="enviar">
        </form>
    </div>

    <div class="direita">
        <table>
            <tr id="titulo">
                <td>titulo</td>
                <td>resumo</td>
                <td>texto</td>
                <td>dataRecepcao</td>
                <td>areaConhecimento</td>
                <td>nota</td>
                <td>autores</td>
            </tr>

            <?php
            $dados = $artigo->consultarArtigo();

            if (count($dados) > 0) {
                for ($i = 0; $i < count($dados); $i++) {
                    echo "<tr>";
                    foreach ($dados[$i] as $k => $v) {
                        if ($k != "id") {
                            echo "<td>" . $v . "</td>";
                        }
                    }
            ?>
                    <td>
                        <button href="">Editar</button>
                        <button href="">Excluir</button>
                    </td>
            <?php


                    echo "</tr>";
                }
            }
            ?>

        </table>

    </div>

</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $titulo = $_POST['titulo'];
    $resumo = $_POST['resumo'];
    $texto = $_POST['texto'];
    $data = $_POST['data'];
    $autores = $_POST['autores'];
    $areaConhecimento = $_POST['areaConhecimento'];
    $nota = $_POST['nota'];


    //converter o formato da data de dd/mm/YYYY para YYYY/mm/dd
    echo date('d-m-y', strtotime($data));
    echo "<br>";
    $data = date('d-m-y', strtotime(str_replace('/', '-', $data)));
    echo date('y-m-d', strtotime($data));


    try {
        $artigo->inserirArtigo($titulo, $resumo, $texto, $data, $autores, $areaConhecimento, $nota);
        header("location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo "Erro no BD " . $e->getMessage();
        exit();
    } catch (Exception $e) {
        echo "Erro genérico " . $e->getMessage();
    }
}
?>