<?php
require_once("conecta_bd.php");
function checaLogin($tabela, $email, $senha){
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = $conexao->prepare("select * from $tabela where email = ? and senha = ?");
    $query->bindParam(1,$email);
    $query->bindParam(2,$senhaMd5);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    return $retorno;
}

function consultaStatusClienteTerceirizado($tabela, $cod_usuario, $status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("select count(*) as total from $tabela where cod_cliente = ? and status = ?");
    $query->bindParam(1,$cod_usuario);
    $query->bindParam(2,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);
    return $total;
}

function listaDados($tabela){
    $conexao = conecta_bd();
    $query = $conexao->prepare("select * from $tabela");
    $query->execute();
    $lista = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
  }

function buscaDadoseditarPerfil($tabela, $codigo){
    $conexao = conecta_bd();
    $query = $conexao->prepare("select * from $tabela where cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $lista = $query->fetch(PDO::FETCH_ASSOC);
    return $lista;
}
function editarDados($codigo,$tabela,$dados){
    $conexao = conecta_bd();
    $query = $conexao->prepare("select * from $tabela where cod = ?");
    $query->bindParam(1,$codigo);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);
    if(count($retorno)>0){
        $campos = implode(' = ?, ', array_keys($dados)) . ' = ?';
        $sql = "update $tabela set " . $campos . " where codigo = " . $codigo;
        $stmt = $query = $conexao->prepare($sql);
        $count = 1;
        foreach($dados as $valor){
            $stmt->bindParam($count,$valor);
            $count++;
        }
        if($query->execute()){
            return $query->rowCount();
        }
    }
}

?>