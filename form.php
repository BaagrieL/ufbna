<?php
require_once 'select.php';
$aluno = new Aluno("UFBNA", "localhost", "root", "Bagriel#2006");
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
        <form action="form.php" method="post">
            <input type="text" name="name">
            <input type="email" name="email" id="email">
            <input type="submit" value="enviar">
        </form>
    </div>

    <div class="direita">
        <table>
            <tr id="titulo">
                <td>nome</td>
                <td>email</td>
                <td></td>
            </tr>

            <?php
            $dados = $aluno->consultarAluno();

                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo "<tr>";
                        foreach ($dados[$i] as $k => $v) {
                            if ($k != "id") {
                                echo "<td>".$v."</td>";
                            }
                        }
            ?>
                        <td>
                            <button href="form.php?id=<?php $dados[$i]['id'];?>">Editar</button> 
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
require_once ('./select.php');



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nome = $_POST['name'];
    $email = $_POST['email'];


    try {
        $aluno->inserirAluno($nome, $email);
        header("location: " . $_SERVER['PHP_SELF']);
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