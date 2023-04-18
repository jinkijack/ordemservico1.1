<?php
require_once("conecta_bd.php");
function consultaStatusUsuario($status){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT count(*) AS total FROM ordem WHERE status = ?");

    $query->bindParam(1,$status);
    $query->execute();
    $total = $query->fetchAll(PDO::FETCH_ASSOC);
    return $total;
}

function listaOrdem(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                o.cod As cod,
                                c.nome AS nome_cliente,
                                t.nome AS nome_terceirizada,
                                s.nome AS nome_servico,
                                o.data_servico AS data_servico,
                                o.status AS status
                            FROM
                                ordem o, servico s, cliente c, terceirizado t
                            WHERE
                                o.cod_cliente = c.cod AND
                                o.cod_servico = s.cod AND
                                o.cod_terceirizado = t.cod");
        $query->execute();
        $lista = $query->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
    
}
?>