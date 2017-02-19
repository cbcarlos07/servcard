<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class UsuarioDAO
{
     private $connection = null;

     public function insert (Usuario $usuario){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO usuario 
                      (CD_USUARIO, NM_USUARIO, DS_LOGIN, DS_SENHA, SN_ATIVO, CD_CARGO, NR_CPF, NR_RG, DS_FOTO) VALUES 
                      (NULL, :usuario, :login, :senha, :ativo, :cargo, :cpf, :rg, :foto)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":usuario", $usuario->getNmUsuario(), PDO::PARAM_STR);
             $stmt->bindValue(":login", $usuario->getDsLogin(), PDO::PARAM_STR);
             $stmt->bindValue(":senha", $usuario->getDsSenha(), PDO::PARAM_STR);
             $stmt->bindValue(":ativo", $usuario->getSnAtivo(), PDO::PARAM_STR);
             $stmt->bindValue(":cargo", $usuario->getCargo()->getCdCargo(), PDO::PARAM_INT);
             $stmt->bindValue(":cpf", $usuario->getNrCPF(), PDO::PARAM_STR);
             $stmt->bindValue(":rg", $usuario->getNrRg(), PDO::PARAM_STR);
             $stmt->bindValue(":foto", $usuario->getDsFoto(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Usuario $usuario){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE usuario SET 
                      NM_USUARIO = :usuario, DS_LOGIN = :login, DS_SENHA = :senha
                      , SN_ATIVO = :senha, CD_CARGO = :cargo, NR_CPF = :cpf, NR_RG = :rg, DS_FOTO = :foto
                      WHERE CD_USUARIO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":usuario", $usuario->getNmUsuario(), PDO::PARAM_STR);
            $stmt->bindValue(":login", $usuario->getDsLogin(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $usuario->getDsSenha(), PDO::PARAM_STR);
            $stmt->bindValue(":ativo", $usuario->getSnAtivo(), PDO::PARAM_STR);
            $stmt->bindValue(":cargo", $usuario->getCargo()->getCdCargo(), PDO::PARAM_INT);
            $stmt->bindValue(":cpf", $usuario->getNrCPF(), PDO::PARAM_STR);
            $stmt->bindValue(":rg", $usuario->getNrRg(), PDO::PARAM_STR);
            $stmt->bindValue(":foto", $usuario->getDsFoto(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $usuario->getCdUsuario(), PDO::PARAM_INT);
            $stmt->execute();

            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function delete ($codigo){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "DELETE FROM usuario WHERE CD_USUARIO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();

            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function getList($nome){
        require_once ("../services/UsuarioList.class.php");
        require_once ("../beans/Usuario.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $usuarioList = new UsuarioList();

        try {

                $sql = "SELECT *
                          FROM usuario E
                          WHERE E.NM_USUARIO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCdUsuario($row['CD_USUARIO']);
                $usuario->setNmUsuario($row['NM_USUARIO']);
                $usuario->setDsLogin($row['DS_LOGIN']);
                $usuario->setDsSenha($row['DS_SENHA']);
                $usuario->setSnAtivo($row['SN_ATIVO']);
                $usuario->setCargo(new Cargo());
                $usuario->getCargo()->setCdCargo($row['CD_CARGO']);
                $usuario->getCargo()->setDsCargo($row['DS_CARGO']);
                $usuario->setDsFoto($row['DS_FOTO']);
                $usuarioList->addUsuario($usuario);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuarioList;
    }

    public function getUsuario($codigo){
        $usuario = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM usuario E
                          WHERE E.CD_USUARIO= :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $usuario = new Usuario();
                $usuario->setCdUsuario($row['CD_USUARIO']);
                $usuario->setNmUsuario($row['NM_USUARIO']);
                $usuario->setDsLogin($row['DS_LOGIN']);
                $usuario->setDsSenha($row['DS_SENHA']);
                $usuario->setSnAtivo($row['SN_ATIVO']);
                $usuario->setCargo(new Cargo());
                $usuario->getCargo()->setCdCargo($row['CD_CARGO']);
                $usuario->getCargo()->setDsCargo($row['DS_CARGO']);
                $usuario->setDsFoto($row['DS_FOTO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $usuario;
    }
}