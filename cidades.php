<div class="container">
    <div class="border-bottom py-4">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <form method="post" id="formulario">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <span class="message"> <strong>Atenção!</strong> </span>
                            </div>
                        </div>
                    </div>


                    <div class="card h-100">
                        <div class="card-header">
                            Estados
                            <select class="form-control" id="estados" name="estados">
                                <option value="T" selected>Todos os Estados</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="PR">Paraná</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <td colspan="4" class="text-right"><a id="add_cidade"
                                                                              class="btn btn-outline-secondary"><i
                                                        class="fa fa-plus-circle fa-lg text-success"></i> Nova Cidade
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>CIDADES</th>
                                        <th>ESTADO</th>
                                        <th>POPULAÇÃO</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="body_table">
                                    <?php

                                    $query = query($conn, "SELECT cidades.id_cidades, cidades.cidade,estados.estado, cidades.populacao FROM cidades JOIN estados ON cidades.id_estados = estados.id_estados", array());
                                    if (count($query) > 0) {
                                        foreach ($query as $row) {
                                            ?>
                                            <tr>
                                                <td><?= $row['cidade'] ?></td>
                                                <td><?= $row['estado'] ?></td>
                                                <td><?= number_format($row['populacao'], 0, ',', '.') ?></td>
                                                <td><a name="btn_deleta" id="<?= $row['id_cidades'] ?>"><i
                                                                class="fa fa-trash text-danger fa-lg"></i></a></td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $(".alert").hide();

    $("a[name=btn_deleta]").click(function () {
        var id_cidades = $(this).attr("id");

        var box = bootbox.confirm("Tem certeza que deseja excluir ?", function (e) {
            if (e) {

                $.ajax({
                    type: 'POST',
                    url: 'exclui_cidade.php',
                    data: {id_cidades: id_cidades},
                    beforeSend: function () {

                    },
                    success: function (data) {
                        if (data == "ok") {
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            bootbox.alert("" + data);
                        }
                    }
                }).fail(function () {

                });

            }
        });

    });

    $("#add_cidade").click(function () {
        var response;
        $.ajax({
            type: "GET",
            url: "add_linha.php",
            async: false,
            success: function (text) {
                response = text;
            }
        });
        $("#body_table").append("" + response + "");
    });

    $("#formulario").submit(function (e) {
        e.preventDefault();


        $.ajax({
            type: 'POST',
            url: 'salva_cidade.php',
            data: $("#formulario").serialize(),
            beforeSend: function () {

            },
            success: function (data) {
                if (data == "ok") {
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                } else {
                    $("#form_lanca").hide();
                    $(".alert").show();
                    $(".message").html(data);
                }
            }
        }).fail(function () {

        });


    });
</script>