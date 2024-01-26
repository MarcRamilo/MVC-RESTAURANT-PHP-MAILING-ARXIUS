<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<h1 class="text-center">Llistat de Reservas de Torn: 1</h1>
<!-- filtrar per data -->
<form action="/table/listByDayListTab1/" method="get" class="mb-3">
    <label for="day" class="form-label">Selecciona un día:</label>
    <input type="date" class="form-control" name="day" id="day" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d"))); ?>">
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>
<a href="/table/listTables2" class="btn btn-primary text-center">Canviar Torn </a>
<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID Taula</th>
            <th>ID Reservation</th>
            <th>Reserva INFO</th>
            <th>Usuari</th>
            <th>Data</th>
            <th>Num Pers</th>
            <th>Torn</th>
            <th>Acció 1</th>
            <th>Acció 2</th>
        </tr>
    </thead>

    <tbody>
        <?php if (isset($params['listDay1'])) {
            $llista = $params['listDay1'];
        
        } else {
            $llista = $params['llista1'];
           
        } ?>
        <?php foreach ($llista as $table) : ?>
            <tr>
                <td><?php echo $table["id"]; ?></td>
                <td><?php echo is_array($table["id_reservation"]) ? implode(', ', $table["id_reservation"]) : $table["id_reservation"]; ?></td>
                <td>
                    <?php
                    if ($table["id_reservation"]) {
                        echo 'ID Reserva: ' . (is_array($table["id_reservation"]) ? implode(', ', $table["id_reservation"]) : $table["id_reservation"]) . '<br><br>';
                        echo 'Data: ' . (is_array($table["data_reserva"]) ? implode(', ', $table["data_reserva"]) : $table["data_reserva"]) . '<br><br>';
                        echo 'Torn: ' . (isset($table["torn"]) ? $table["torn"] : '') . '<br><br>';
                        echo 'Número de Personas: ' . (is_array($table["numero_persones"]) ? implode(', ', $table["numero_persones"]) : $table["numero_persones"]) . '<br><br>';
                    } else {
                        echo 'No hi han reserves asociades';
                    }
                    ?>
                </td>

                <td><?php echo isset($table["name_reservation"]) ? $table["name_reservation"] : ''; ?></td>
                <td><?php echo is_array($table["data_reserva"]) ? implode(', ', $table["data_reserva"]) : $table["data_reserva"]; ?></td>
                <td><?php echo is_array($table["numero_persones"]) ? implode(', ', $table["numero_persones"]) : $table["numero_persones"]; ?></td>
                <td><?php echo $table["torn"]; ?></td>
              
                <td>
                    <a href="/reservation/create/?id_table=<?php echo $table['id']; ?>" class="btn btn-success">
                        Fer Reserva
                </td>
                <td>
                    <a href="/table/liberate/?id_table=<?php echo $table['id']; ?>" class="btn btn-danger">
                        Lliurar Reserva
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/reservation/create" class="btn btn-primary">Fer Reserva</a>

</body>

</html>