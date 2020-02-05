<?php
include_once("includes/include.php");


$soma = $vl_dolar = $custo_pessoa = $qtd_corte_desc = $desc_pessoa_corte = $custo = 0;

if (isset($_POST['estado']) && !empty($_POST['estado'])) {
    $estado = remove($_POST['estado']);

    $query = query($conn, "SELECT SUM(populacao)as soma  FROM cidades WHERE id_estados IN (SELECT id_estados FROM estados WHERE uf = :uf )", array(":uf" => $estado));
    if (count($query) > 0) {
        $soma = $query[0]['soma'];
    }


    $url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='02-04-2020'";
    $json = json_decode(file_get_contents($url));
    if (is_object($json))
        $vl_dolar = $json->value[0]->cotacaoCompra;


    $queryConf = query($conn, "SELECT * FROM configura LIMIT 1 ", array());
    if (count($queryConf) > 0) {
        $custo_pessoa = $queryConf[0]['custo_pessoa'];
        $qtd_corte_desc = $queryConf[0]['qtd_corte_desc'];
        $desc_pessoa_corte = $queryConf[0]['desc_pessoa_corte'];
    }


    if ($soma > $qtd_corte_desc) {

        $sobra = $soma - $qtd_corte_desc;

        $custo = $qtd_corte_desc * $custo_pessoa;

        $custo += ($custo_pessoa - ($custo_pessoa * ($desc_pessoa_corte / 100))) * $sobra;


    } else {
        $custo = $custo_pessoa * $soma;
    }


} else {
    exit("O Estado deve ser preenchido!");
}

?>


<table class="table table-hover">
    <tr>
        <td>População</td>
        <td><?= number_format($soma, 0, ',', '.') ?></td>
    </tr>
    <tr>
        <td>Custo População</td>
        <td>R$ <?= number_format($custo, 2, ',', '.') ?></td>
    </tr>
</table>
