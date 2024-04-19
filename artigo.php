<?php
class Artigo
{
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
            $cmd = $this->pdo->query("SELECT * FROM artigo ORDER BY id");
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

    public function inserirArtigo($titulo, $resumo, $texto, $data, $autores, $areaConhecimento, $nota)
    {
        try {
            $ras = $this->pdo->prepare("INSERT INTO artigo (titulo, resumo, autores, texto, dataRecepcao, autores, areaConhecimento, nota) VALUES (:titulo, :resumo, :autores, :texto, :dataRecepcao, :autores, :areaConhecimento, :nota);");
    
            $ras->bindParam(':titulo', $titulo);
            $ras->bindParam(':resumo', $resumo);
            $ras->bindParam(':texto', $texto);
            $ras->bindParam(':data', $data);
            $ras->bindParam(':autores', $autores);
            $ras->bindParam(':areaConhecimento', $areaConhecimento);
            $ras->bindParam(':nota', $nota);
    
            $ras->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Erro genérico " . $e->getMessage();
        }
    }
}
