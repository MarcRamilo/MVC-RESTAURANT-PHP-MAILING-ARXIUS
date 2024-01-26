<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<form action="/reservation/listByDayReservations/" method="get" class="mb-3">
    <label for="day" class="form-label">Selecciona un día:</label>
    <input type="date" class="form-control" name="day" id="day" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d"))); ?>">
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>
<h1 class="text-center">Llistat de Reservas</h1>

<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Taula</th>
            <th>Nom</th>
            <th>Data</th>
            <th>Torn</th>
            <th>Número de Persones</th>
            <th>Observacions</th>
            <th>Usuari</th>
            <th>Ocupat</th>
            <th>Acció 1</th>
            <th>Acció 2</th>
            <th>Acció 3</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($params['llista'] as $reservation) : ?>
            <tr>
                <td><?php echo $reservation["id_reservation"]; ?></td>
                <td><?php echo $reservation["id_table"]; ?></td>
                <td><?php echo $reservation["name_reservation"]; ?></td>
                <td><?php echo $reservation["date"]; ?></td>
                <td><?php echo $reservation["hour"]; ?></td>
                <td><?php echo $reservation["n_pers_reservation"]; ?></td>
                <td><?php echo $reservation["observations"]; ?></td>
                <td><?php echo $reservation["username"]; ?></td>
                <td><?php echo $reservation["ocupat"]  ? 'si' : 'no'; ?></td>
                <td><a href="/reservation/edit/?id_reservation=<?php echo $reservation['id_reservation']; ?>" class="btn btn-primary">Editar</a></td>
                <td><a href="/reservation/delete/?id_reservation=<?php echo $reservation['id_reservation']; ?>" class="btn btn-danger">Eliminar</a></td>
                <td>
                    <a href="/reservation/changeState/?id_reservation=<?php echo $reservation['id_reservation']; ?>" class="<?php echo $reservation['ocupat'] ? 'btn btn-danger' : 'btn btn-success'; ?>">
                        Canviar Estat (Act:<?php echo $reservation['ocupat'] ? 'ocupat' : 'lliure'; ?>)
                    </a>
                </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/reservation/create" class="btn btn-primary">Fer Reserva</a>

</body>

</html>