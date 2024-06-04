<?php
require_once 'autor_class.php';
$aluno = new Aluno("UFBNA", "localhost", "root", "123456");
?>

<!DOCTYPE html>
<html lang="en">

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
            <form action="form.php" method="POST" class="form-select">
                <div class="input-group mb-3">
                    <input id="input-name" name="name" type="text" class="form-control" placeholder="Nome" aria-label="Username" value="<?php if(isset($_GET["id_up"])){echo $_GET['nome'];} ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">@</span>
                    <input id="input-email" name="email" type="text" class="form-control" placeholder="Email" aria-label="Server" value="<?php if(isset($_GET["id_up"])){echo $_GET['email'];} ?>">
                </div>
                <input class="btn btn-primary" type="submit" value="enviar">
            </form>
        </div>

        <div class="direita">
            <table class="table table-striped table-hover">
                <thead>
                    <tr id="titulo">
                        <th scope="col">nome</th>
                        <th scope="col">email</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dados = $aluno->consultarAluno();
                    if (count($dados) > 0) {
                        for ($i = 0; $i < count($dados); $i++) {
                            echo "<tr>";
                            foreach ($dados[$i] as $k => $v) {
                                // if ($k != "AutorID") {
                                echo "<td>" . ($v) . "</td>";
                                // }
                            }
                    ?>
                            <td>
                                <a href="form.php?id=<?php echo ($dados[$i]['AutorID']); ?>&nome=<?php echo ($dados[$i]['NomeAutor']); ?>">Excluir</a>
                                <a href="form.php?id_up=<?php echo $dados[$i]['AutorID']; ?>&nome=<?php echo $dados[$i]['NomeAutor']; ?>&email=<?php echo $dados[$i]['EmailAutor']; ?>">Editar</a>

                            </td>
                    <?php
                            echo "</tr>";
                        }
                    } else { // O banco está vazio
                        echo "Ainda não há pessoas cadrastadas!";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </main>

    <dialog>

    </dialog>

</body>

</html>


<?php
require_once('./autor_class.php');

// ------------------EXCLUIR----------------------
if (isset($_GET["id"])) {
    $idAluno = addslashes($_GET["id"]);
    $nomeAluno = addslashes($_GET["nome"]);

    echo "
        <script type='text/javascript'>
            let idAluno = " . (isset($idAluno) ? $idAluno : 'null') . ";
            let nomeAluno = '" . (isset($nomeAluno) ? $nomeAluno : '') . "';

            if (idAluno !== null && window.confirm('Quer mesmo EXCLUIR ' + nomeAluno + '?')) {
                console.log('foi id: ' + idAluno);

                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'form.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log('ok');
                            window.location.href = 'form.php';
                        } else {
                            console.error('Erro ao excluir aluno');
                        }
                    }
                };
                xhr.send('id=' + idAluno);
            } else {
                console.log('Não excluído');
            }
        </script>
    ";
}

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $aluno->excluirAluno($id);
} else {
    echo "Erro: ID do aluno não fornecido.";
    exit;
}



// ------------------EDITAR----------------------
if(isset($_GET['id_up']) && !empty($_GET['id_up'])){
    $id_up = addslashes($_GET['id_up']);
    $nome_up = addslashes($_POST['nome']);
    $email_up = addslashes($_POST['email']);

    if (!empty($nome) && !empty($email)) { 
        if($aluno->editarAluno($id_up, $nome_up, $email_up)){

            echo "
                <script type='text/javascript'>
                        window.location.href = 'form.php';
                </script>
                ";
            
        }
    } else {
        echo "Preencha todos os campos";
    } 

}

// ------------------INSERIR----------------------
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['name'])) {
    $nome = $_POST['name'];
    $email = $_POST['email'];


    try {
        if ($aluno->inserirAluno($nome, $email)) {
            echo "
            <script type='text/javascript'>
                    window.location.href = 'form.php';
            </script>
            ";
        }

        exit();
    } catch (PDOException $e) {
        echo "Erro no BD " . $e->getMessage();
        exit();
    } catch (Exception $e) {
        echo "Erro genérico " . $e->getMessage();
    }


    // ---------------------- Insert ----------------------------

    // try {
    //     $ras = $pdo->prepare('INSERT INTO ALUNO(nome, email) VALUES (:n, :e)');

    //     $ras->bindParam(':n', $nome);
    //     $ras->bindValue(':e', $email);

    //     $ras->execute();
    // } catch (PDOException $e) {
    //     echo "Erro ao inserir dados: " . $e->getMessage();
    // } catch (Exception $e) {
    //     echo "Erro genérico " . $e->getMessage();
    // }



    // --------------------- Delete -------------------------------

    // if  (isset($_GET["id"])) {
    //     $idAluno = addslashes( $_GET["id"]);
    //     $aluno->excluirAluno($idAluno);
    // }  

    // try {
    //     $cmd = $pdo->prepare("DELETE FROM ALUNO WHERE nome = :n");
    //     $cmd->bindParam(":n", $nome);
    //     $cmd->execute();
    //     echo"$nome Deletado(a)";
    // }

    // catch (PDOException $e) {
    //     echo "Erro ao deletar ". $e->getMessage();
    //     exit();
    // }

    // catch (Exception $e) {
    //     echo "Erro genérico ". $e->getMessage();
    // }


    // --------------------- Update --------------------------------

    // $cmd = $pdo->prepare("UPDATE ALUNO SET nome = :e WHERE nome = :n");
    // $cmd->bindParam(":n", $nome, PDO::PARAM_STR);
    // $cmd->bindParam(":e", $email, PDO::PARAM_STR);
    // $cmd->execute();


    //  -------------------- Select -------------------------------

    // $cmd = $pdo->prepare("SELECT * FROM ALUNO");
    // $cmd->execute();
    // $result = $cmd ->fetchAll(PDO::FETCH_ASSOC);


    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";


}
?>