<div class="container">
    <div class="border-bottom py-4">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Estados
                        <select class="form-control" id="estados" name="estados">
                            <option value="RS">Rio Grande do Sul</option>
                            <option value="SC" selected>Santa Catarina</option>
                            <option value="PR">Paraná</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <div id="img_bandeira">
                            <img src="image/santacatarina.png" width="500px"/>
                        </div>
                    </div>

                    <div class="card-footer" id="resumo">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $("#estados").change(function () {
        if ($(this).val() == "PR")
            $("#img_bandeira").html('<img src="image/parana.png" width="500px"/>');
        else if ($(this).val() == "RS")
            $("#img_bandeira").html('<img src="image/riograndedosul.png" width="500px"/>');
        else if ($(this).val() == "SC")
            $("#img_bandeira").html('<img src="image/santacatarina.png" width="500px"/>');


        resumo();
    });


    function resumo() {

        $.ajax({
            type: 'POST',
            url: 'resumo.php',
            data: {estado: $("#estados").val()},
            beforeSend: function () {

            },
            success: function (data) {
                $("#resumo").html(data);
            }
        }).fail(function () {
        });
    }


    resumo();
</script>

