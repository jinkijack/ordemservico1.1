<?php
function consultaStatusUsuario($status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total FROM ordem WHERE status = ?");

    $query->bindParam(1,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);
    return $total;
}
?>