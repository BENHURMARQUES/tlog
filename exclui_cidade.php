<?php
include_once("includes/include.php");


if (isset($_POST['id_cidades']) && (int)$_POST['id_cidades'] > 0) {
    $id_cidades = (int)remove($_POST['id_cidades']);

    $query = query($conn, "SELECT cidades.id_cidades,estados.uf FROM cidades JOIN estados  ON cidades.id_estados = estados.id_estados WHERE cidades.id_cidades = :id_cidades ", array(":id_cidades" => $id_cidades));
    if (count($query) > 0) {
        $row = $query[0];

        if ($row['uf'] == "RS")
            exit("Exclusão não permitida!");


        if (!executa($conn, "DELETE FROM cidades WHERE id_cidades = :id_cidades ", array(":id_cidades" => $id_cidades))) {
            exit("Um erro correu!");
        }

        exit("ok");
    }
}
exit("erro");