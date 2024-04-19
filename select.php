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
            $cmd = $this->pdo->query("SELECT * FROM ALUNO ORDER BY nome");
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

        try {
            $ras = $this->pdo->prepare('INSERT INTO ALUNO(nome, email) VALUES (:n, :e)');

            $ras->bindParam(':n', $nome);
            $ras->bindValue(':e', $email);

            $ras->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
        }
    }

    public function excluirAluno($idAluno)
    {
        try {
            $cmd = $this->pdo->prepare("DELETE FROM ALUNO WHERE id = :i");
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
}
