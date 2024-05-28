<?php
require_once 'autor_class.php';
require_once 'professor_class.php';

$aluno = new Aluno("UFBNA", "localhost", "root", "123456");
$professor = new Professor("UFBNA", "localhost", "root", "123456");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style/inscreva-se.css">
    <!-- components -->
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./components/header.css">
    <link rel="stylesheet" href="./components/nav.css">
    <link rel="stylesheet" href="./components/footer.css">
    <title>Formulários</title>
</head>

<body>
    <?php include_once './components/header.php' ?>

    <main>
        <div class="form-container">
            <div class="toggle-buttons">
                <div>
                    <button id="aluno-button" class="active">Aluno</button>
                    <button id="professor-button">Professor</button>
                </div>
            </div>
            <form id="aluno-form" class="active-form" action="inscreva-se.php" method="POST">
                <h2>Formulário do Aluno</h2>
                <div>
                    <input name="aluno-name" type="text" placeholder="Nome">
                    <input name="aluno-email" type="email" placeholder="E-mail">
                </div>

                <button class="button-enviar" type="submit">Enviar</button>
            </form>
            <form id="professor-form" action="inscreva-se.php" method="POST">
                <h2>Formulário do Professor</h2>
                <div>
                    <input name="professor-name" type="text" placeholder="Nome">
                    <input name="professor-email" type="email" placeholder="E-mail">
                </div>

                <button class="button-enviar" type="submit">Enviar</button>
            </form>
            <?php
            require_once('./autor_class.php');

            if ($_SERVER['REQUEST_METHOD'] === "POST") {

                if (isset($_POST['aluno-name'])) {

                    $nome = $_POST['aluno-name'];
                    $email = $_POST['aluno-email'];

                    try {

                        if ($aluno->inserirAluno($nome, $email) == true) {
                            echo "<script>
                                    setTimeout(function() {
                                    window.location.href = 'main.php';
                                    }, 1000);
                                </script>";
                        } else {
                            echo "<h3>insira todos os campos</h3>";
                        }

                        exit();
                    } catch (PDOException $e) {
                        echo "Erro no BD " . $e->getMessage();
                        exit();
                    } catch (Exception $e) {
                        echo "Erro genérico " . $e->getMessage();
                    }
                } elseif (isset($_POST['professor-name'])) {

                    $nome = $_POST['professor-name'];
                    $email = $_POST['professor-email'];

                    try {
                        $professor->inserirProfessor($nome, $email);
                        echo "<script>
                                    setTimeout(function() {
                                    window.location.href = 'main.php';
                                    }, 1000);
                                </script>";
                        exit();
                    } catch (PDOException $e) {
                        echo "Erro no BD " . $e->getMessage();
                        exit();
                    } catch (Exception $e) {
                        echo "Erro genérico " . $e->getMessage();
                    }
                } else {
                    echo "deu pau :/";
                }
            }

            ?>
        </div>
    </main>

    <?php include_once './components/footer.php' ?>

    <script>
        const alunoButton = document.getElementById('aluno-button');
        const professorButton = document.getElementById('professor-button');
        const alunoForm = document.getElementById('aluno-form');
        const professorForm = document.getElementById('professor-form');
        const buttonEnviar = document.querySelectorAll('.button-enviar');

        alunoButton.addEventListener('click', () => {
            alunoForm.classList.add('active-form');
            professorForm.classList.remove('active-form');
            alunoButton.classList.add('active');
            professorButton.classList.remove('active');
        });

        professorButton.addEventListener('click', () => {
            professorForm.classList.add('active-form');
            alunoForm.classList.remove('active-form');
            professorButton.classList.add('active');
            alunoButton.classList.remove('active');
        });
    </script>
</body>

</html>