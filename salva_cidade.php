<?php
include_once("includes/include.php");

if (isset($_POST['estado']) && !empty($_POST['estado']))
    $estado = removeDeep($_POST['estado']);
else
    exit("O Estado deve ser preenchido!");

if (isset($_POST['cidade']) && !empty($_POST['cidade']))
    $cidade = removeDeep($_POST['cidade']);
else
    exit("A Cidade deve ser preenchida!");

if (isset($_POST['populacao']) && !empty($_POST['populacao']))
    $populacao = removeDeep($_POST['populacao']);
else
    exit("A População deve ser preenchida!");


for ($x = 0; $x < count($cidade); $x++) {

    $nome_cidade = $cidade[$x];
    $uf = $estado[$x];
    $qtdp = (int)str_replace(".", "", $populacao[$x]);

    if (strlen($nome_cidade) == 0) exit("Todos os nomes de cidades devem ser preenchidos!");
    if (strlen($uf) == 0) exit("Todos os estados devem ser preenchidos!");
    if ($qtdp == 0) exit("Todos os campos de população devem ser preenchidos!");


    $array = array(
        ":cidade" => $nome_cidade,
        ":uf" => $uf
    );
    $query = query($conn, "SELECT * FROM cidades WHERE cidade = :cidade AND id_estados IN (SELECT id_estados FROM estados WHERE uf = :uf) ", $array);
    if (count($query) > 0) {
        exit($nome_cidade . " já existe!");
    }

    $array = array(
        ":uf" => $uf,
        ":cidade" => $nome_cidade,
        ":ibge" => NULL,
        ":populacao" => $qtdp
    );
    if (!executa($conn, "INSERT INTO cidades VALUES(NULL,(SELECT id_estados FROM estados WHERE uf = :uf),:cidade,:ibge,:populacao)", $array)) {
        exit("UM ERRO OCORREU NO INSERT!");
    }
}
exit("ok");