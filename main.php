<?php
require_once 'artigo.php';
$artigo = new Artigo("UFBNA", "localhost", "root", "Bagriel#2006");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style/other.css">
    <link rel="stylesheet" href="components/cardArtigo.css">
    <link rel="stylesheet" href="components/reset.css">
    <link rel="stylesheet" href="components/header.css">
    <link rel="stylesheet" href="components/nav.css">
    <link rel="stylesheet" href="components/footer.css">

    <title>Document</title>
</head>

<body>
    <?php include_once 'components/header.php'; ?>

    <main>
        <div class="hero_container">
            <div class="title">
                <h3>Artigos recentes</h3>
            </div>
            <div class="card_container">
                <?php
                $dados = $artigo->consultarArtigo();
                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo "<div class='card'>";
                        foreach ($dados[$i] as $k => $v) {
                            if ($k === "titulo") {
                                echo "<a href=''>" . $v . "</a>";
                            }
                            if ($k != "id" & $k != "texto" & $k != "dataRecepcao" & $k != "nota" & $k != "resumo" & $k != "titulo") {

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
</body>

</html>