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

function cadastraOrdem($cod_cliente,$cod_servico,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_bd();

    $query = $conexao->prepare("INSERT INTO ordem (cod_cliente, cod_servico, cod_terceirizado, data_servico, status, data) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bindParam(1, $cod_cliente);
    $query->bindParam(2, $cod_servico);
    $query->bindParam(3, $cod_terceirizado);
    $query->bindParam(4, $data_servico);
    $query->bindParam(5, $status);
    $query->bindParam(6, $data);
    $retorno = $query->execute();
    if ($retorno) {
        return 1;
    } else {
        return 0;
    }
}

function buscaOrdemadd(){
    $conexao = conecta_bd();
    $query = $conexao->prepare("SELECT
                                c.nome AS nome_cliente,
                                t.nome AS nome_terceirizada,
                                s.nome AS nome_servico,
                                s.valor as valor_servico,
                                o.data_servico AS data_servico,
                                o.status AS status
                            FROM
                                ordem o, servico s, cliente c, terceirizado t
                            WHERE
                                o.cod_cliente = c.cod AND
                                o.cod_servico = s.cod AND
                                o.cod_terceirizado = t.cod
                                order by o.cod desc limit 1"
                                );
        $query->execute();
        $lista = $query->fetch(PDO::FETCH_ASSOC);
        return $lista;
}

?>