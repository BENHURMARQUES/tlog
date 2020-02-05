<?php
include_once("includes/include.php");
?>
<div class="container">
    <div class="border-bottom py-4">
        <div class="row">
            <div class="col-lg-12 mb-4">

                <div class="card h-100">
                    <div class="card-header">

                        Lista de Estados
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th class="text-right">População</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $query = query($conn, "SELECT * FROM estados ORDER BY uf ", array());
                                if (count($query) > 0) {
                                    foreach ($query as $row) {

                                        $soma = 0;

                                        $queryCidades = query($conn, "SELECT SUM(populacao)as soma FROM cidades WHERE id_estados = :id_estados ", array(":id_estados" => $row['id_estados']));
                                        if (count($queryCidades) > 0) {
                                            $soma = $queryCidades[0]['soma'];
                                        }


                                        ?>
                                        <tr>
                                            <td><?= $row['estado'] ?></td>
                                            <td class="text-right"><?= number_format($soma, 0, ',', '.') ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

