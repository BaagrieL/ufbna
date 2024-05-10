<?php
require_once 'artigo.php';
$artigo = new Artigo("UFBNA", "localhost", "root", "123456");
$excluirChaves = array("ArtigoID", "ResumoArtigo", "TextoArtigo",  "DataRecepcao");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/other.css">
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="components/cardArtigo.css">
    <link rel="stylesheet" href="components/reset.css">
    <link rel="stylesheet" href="components/header.css">
    <link rel="stylesheet" href="components/nav.css">
    <link rel="stylesheet" href="components/footer.css">
    <link rel="stylesheet" href="components/aside.css">

    <title>Document</title>
</head>

<body>
    <?php include_once 'components/header.php'; ?>

    <main>
        <div class="title">
            <h3>Artigos recentes</h3>
        </div>
        <?php include_once 'components/aside.php'; ?>

        <div class="hero_container">
            <div class="cards_container">
                <?php
                $dados = $artigo->consultarArtigo();
                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo "<div class='card shadow-sm p-3 mb-5 bg-body-tertiary rounded'>";

                        foreach ($dados[$i] as $k => $v) {

                            if ($k === "TituloArtigo") {
                                echo "<a href=''>" . $v . "</a>";
                            }
                            // if ($k != "id" & $k != "texto" & $k != "dataRecepcao" & $k != "nota" & $k != "resumo" & $k != "titulo") {

                            //     echo "<p>" . $v . "</p>";
                            // }
                            if (!in_array($k, $excluirChaves)) {
                                echo "<p>" . $v . "</p>";
                            }
                        }
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <?php include_once 'components/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>