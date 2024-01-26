<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<h1 class="text-center">Llistat de Reservas de Torn: 2</h1>
<form action="/table/listByDayListTab2/" method="get" class="mb-3">
    <label for="day" class="form-label">Selecciona un día:</label>
    <input type="date" class="form-control" name="day" id="day" value="<?php echo date('Y-m-d'); ?>" min = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")));?>">
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>
<a href="/table/listTables" class="btn btn-primary">Canviar Torn </a>
<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Num Pers</th>
            <th>Torn</th>
            <th>Ocupat</th>
       
            <th>Acció 1</th>
            <th>Acció 2</th>
            <th>Acció 3</th>
        </tr>
    </thead>
    <tbody>
    <?php if (isset($params['listDay2'])) {
            $llista = $params['listDay2'];
        } else {
            $llista = $params['llista2'];
        } ?>
        <?php foreach ($llista as $table) : ?>
            <tr>
                <td><?php echo $table["id"]; ?></td>
                <td><?php echo $table["data_reserva"]; ?></td>
                <td><?php echo $table["numero_persones"]; ?></td>
                <td><?php echo $table["torn"]; ?></td>
                <td><?php echo $table["ocupat"] ? 'si' : 'no';  ?></td>
                <td>
                    <a href="/table/changeStateTab2/?id_table=<?php echo $table['id']; ?>" class="<?php echo $table['ocupat'] ? 'btn btn-danger' : 'btn btn-success'; ?>" >
                        Canviar Estat (Act:<?php echo $table['ocupat'] ? 'ocupat' : 'lliure'; ?>)
                    </a>
                </td>
                <td>
                    <a href="/table/liberate/?id_table=<?php echo $table['id']; ?>" class="btn btn-success">
                        Fer Reserva
                </td>
                <td>
                    <a href="/table/liberate2/?id_table=<?php echo $table['id']; ?>" class="btn btn-danger">
                        Lliurar Reserva
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/reservation/create" class="btn btn-primary">Fer Reserva</a>

</body>

</html>