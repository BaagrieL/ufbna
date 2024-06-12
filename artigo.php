<?php
class Artigo{
    private $pdo;
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

    public function consultarArtigo()
    {
        try {
            $cmd = $this->pdo->query("SELECT * FROM Artigo ORDER BY ArtigoID");
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


    public function inserirArtigo($titulo, $resumo, $texto, $data, $areaConhecimento) {
        try {
            $res = $this->pdo->prepare("INSERT INTO Artigo(TituloArtigo, ResumoArtigo, TextoArtigo, DataRecepcao, AreaConhecimento) VALUES (:titulo, :resumo, :texto, :dataRecepcao, :areaConhecimento)");
    
            $res->bindParam(':titulo', $titulo);
            $res->bindParam(':resumo', $resumo);
            $res->bindParam(':texto', $texto);
            $res->bindParam(':dataRecepcao', $data);
            $res->bindParam(':areaConhecimento', $areaConhecimento);
            
            $res->execute();
            
            echo "OK";
        } catch (PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
        }
    }

    public function excluirArtigo($idArtigo)
    {
        try {
            $cmd = $this->pdo->prepare("DELETE FROM Artigo WHERE ArtigoID = :i");
            $cmd->bindParam(":i", $idArtigo);
            $cmd->execute();
            echo "Deletado(a)";
        } catch (PDOException $e) {
            echo "Erro ao deletar " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
        }
    }


    public function editarArtigo($id, $titulo, $resumo, $texto, $data, $areaConhecimento)
    {
        $cmd = $this->pdo->prepare("UPDATE Artigo SET TituloArtigo=:titulo,ResumoArtigo=:resumo,TextoArtigo=:texto,DataRecepcao=:dataRecepcao,AreaConhecimento=:areaConhecimento WHERE ArtigoID=:i");

        $cmd->bindParam(':titulo', $titulo);
        $cmd->bindParam(':resumo', $resumo);
        $cmd->bindParam(':texto', $texto);
        $cmd->bindParam(':dataRecepcao', $data);
        $cmd->bindParam(':areaConhecimento', $areaConhecimento);
        $cmd->bindParam(':i', $id);

        $cmd->execute();

    }

    public function totalArtigos() {
        try {
            $cmd = $this->pdo->query("SELECT COUNT(*) AS TotalArtigos FROM Artigo");
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);

            if(isset($res['TotalArtigos']) && $res['TotalArtigos'] == 0) {
                return "nenhum artigo encontrado";
            }

            if(isset($res['TotalArtigos'])) {
                return $res['TotalArtigos'];
            } else {
                return "Erro ao buscar autores";
            }
        } catch (PDOException $e) {
            echo "Erro no BD " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
            exit();
        }
    }

    public function AreaMaisCitada() {
        try {
            $cmd = $this->pdo->query("SELECT AreaConhecimento, COUNT(*) AS TotalArtigos FROM Artigo GROUP BY AreaConhecimento ORDER BY TotalArtigos DESC LIMIT 3;");
            $cmd->execute();
            $res = $cmd->fetch(PDO::FETCH_ASSOC);

            if(isset($res['TotalArtigos']) && $res['TotalArtigos'] == 0) {
                return "nenhum artigo encontrado";
            }

            if(isset($res['TotalArtigos'])) {
                return $res;
            } else {
                return "Erro ao buscar autores";
            }
        } catch (PDOException $e) {
            echo "Erro no BD " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
            exit();
        }
    }
}
