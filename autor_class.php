<?php
class Aluno
{
    protected $pdo;

    public function __construct($dbname, $host, $user, $pass)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $pass);
        } catch (PDOException $e) {
            echo "Erro no BD " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
            exit();
        }
    }


    public function consultarAluno()
    {
        try {
            $cmd = $this->pdo->query("SELECT * FROM Autor ORDER BY NomeAutor");
            $cmd->execute();
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (PDOException $e) {
            echo "Erro no BD " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
            exit();
        }
    }

    public function inserirAluno($nome, $email)
    {
        if ($nome === "" || $email === "") {
            return false;
        }
        
        try {
            $ras = $this->pdo->prepare("INSERT INTO Autor (NomeAutor, EmailAutor) VALUES (:n, :e)");

            $ras->bindParam(':n', $nome);
            $ras->bindValue(':e', $email);

            if ($ras->execute()) {
                echo "<h3>Sucesso!</h3>";
                return true;
            } else {
                echo "<h3>Erro ao inserir dados.</h3>";
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
        }
    }

    public function excluirAluno($idAluno)
    {
        try {
            $cmd = $this->pdo->prepare("DELETE FROM Autor WHERE AutorID = :i");
            $cmd->bindParam(":i", $idAluno);
            $cmd->execute();
            echo "Deletado(a)";
        } catch (PDOException $e) {
            echo "Erro ao deletar " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
        }
    }

    public function editarAluno($id_up, $nome, $email, )
    {
        $cmd = $this->pdo->prepare("UPDATE Autor SET NomeAutor = :n, EmailAutor = :e WHERE AutorID = :i");
        $cmd->bindParam(":n", $nome, PDO::PARAM_STR);
        $cmd->bindParam(":e", $email, PDO::PARAM_STR);
        $cmd->bindParam(":i", $id_up, PDO::PARAM_STR);

        $cmd->execute();

    }
}
