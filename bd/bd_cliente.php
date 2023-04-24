<?php 

require_once("conecta_bd.php");

function checaCliente($email,$senha){
    $conexao = conecta_bd();
    $senhaMD5 = md5($senha);
    $query = $conexao->prepare("SELECT * 
              FROM 	cliente
              WHERE email= ? and 
                senha= ? ");

    $query->bindParam(1,$email);
    $query->bindParam(2,$senhaMD5);
    $query->execute();
    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    return $retorno;
}
function editarPerfilCliente($codigo,$nome,$email,$endereco,$numero,$bairro,$cidade,$telefone,$data){
  $conexao = conecta_bd();

  $query = $conexao->prepare("SELECT * FROM cliente WHERE cod = ?");
  $query->bindParam(1,$codigo);
  $query->execute();
  $retorno = $query->fetch(PDO::FETCH_ASSOC);
  if(count($retorno) > 0){
      $query = $conexao->prepare("UPDATE cliente SET nome = ?, email = ?,endereco = ?,numero =?, bairro = ?,cidade = ?, telefone = ?, data = ? WHERE cod = ?");
      $query->bindParam(1, $nome);
      $query->bindParam(2, $email);
      $query->bindParam(3, $endereco);
      $query->bindParam(4, $numero);
      $query->bindParam(5, $bairro);
      $query->bindParam(6, $cidade);
      $query->bindParam(7, $telefone);
      $query->bindParam(8, $data);
      $query->bindParam(9, $codigo);
      $retorno = $query->execute();//retorno boolean padrao TRUE
      if($retorno){
          return 1;
      } else{
          return 0;
      }        
  }

}
?>