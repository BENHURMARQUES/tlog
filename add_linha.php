<tr>
    <td><input class="form-control" name="cidade[]" required/></td>
    <td>
        <select class="form-control" name="estado[]" required >
            <option value=""></option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="SC">Santa Catarina</option>
            <option value="PR">Paraná</option>
        </select>
    </td>
    <td><input type="number" min="1" class="form-control" name="populacao[]" required/></td>
    <td></td>
</tr>
<script>
    $("input[name='cidade[]']").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });
</script>