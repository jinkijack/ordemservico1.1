<?php 
require_once("conecta_bd.php");
function cadastraServico($nome,$valor,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("insert into servico (nome,valor,data) values(?,?,?)");
    $query->bindParam(1, $nome);
    $query->bindParam(2, $valor);
    $query->bindParam(3, $data);
    $retorno = $query->execute();//retorno boolean padrao TRUE
    if($retorno){
        return 1;
    } else{
        return 0;
    }
}
?>