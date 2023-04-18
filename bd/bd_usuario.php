<?php 

require_once("conecta_bd.php");

function checaUsuario($email,$senha){
    $conexao = conecta_bd();
    $senhaMD5 = md5($senha);
    $query = $conexao->prepare("SELECT * 
              FROM 	usuario 
              WHERE email= ? and 
                senha= ? ");

    $query->bindParam(1,$email);
    $query->bindParam(2,$senhaMD5);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    return $retorno;
}
?>