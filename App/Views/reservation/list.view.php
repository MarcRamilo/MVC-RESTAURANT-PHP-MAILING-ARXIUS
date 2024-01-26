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
    <a href="/reservation/list" class="btn btn-primary">Netejar Filtre</a>
</form>


<h1 class="text-center">Llistat de Reservas Actives</h1>
<h3 class="text-center"><?php echo $params['resultat'] ?? "Resultat sense filtrar" ?></h3>

<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Taula</th>
            <th>Data</th>
            <th>Torn</th>
            <th>Número de Persones</th>
            <th>Observacions</th>
            <th>Usuari</th>
            <th>Ocupat</th>
            <th>Acció 1</th>
            <th>Acció 2</th>
            <th>Acció 3</th>
            <th>Acció 4</th>

        </tr>
    </thead>
    <tbody>
     
        
    <?php foreach ($params['llista'] as $reservation) : ?>
    <?php if (is_array($reservation) && $reservation['ocupat'] === true) : ?>
        <tr>
            <td><?php echo isset($reservation["id_reservation"]) ? $reservation["id_reservation"] : ''; ?></td>
            <td><?php echo isset($reservation["id_table"]) ? $reservation["id_table"] : ''; ?></td>
            <td><?php echo isset($reservation["date"]) ? $reservation["date"] : ''; ?></td>
            <td><?php echo isset($reservation["hour"]) ? $reservation["hour"] : ''; ?></td>
            <td><?php echo isset($reservation["n_pers_reservation"]) ? $reservation["n_pers_reservation"] : ''; ?></td>
            <td><?php echo isset($reservation["observations"]) ? $reservation["observations"] : ''; ?></td>
            <td><?php echo isset($reservation["username"]) ? $reservation["username"] : ''; ?></td>
            <td><?php echo isset($reservation["ocupat"]) ? ($reservation["ocupat"] ? 'si' : 'no') : ''; ?></td>
            <td><a href="/reservation/edit/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="btn btn-primary">Editar</a></td>
            <td><a href="/reservation/delete/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="btn btn-danger">Eliminar</a></td>
            <td>
                <a href="/reservation/changeState/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="<?php echo isset($reservation['ocupat']) ? ($reservation['ocupat'] ? 'btn btn-danger' : 'btn btn-success') : ''; ?>">
                    Canviar Estat (Act:<?php echo isset($reservation['ocupat']) ? ($reservation['ocupat'] ? 'ocupat' : 'lliure') : ''; ?>)
                </a>
            </td>
            <td>
                <a href="/reservation/liberate/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="btn btn-info">Lliurar Reserva</a>
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>
    </tbody>
</table>
<a href="/reservation/create" class="btn btn-primary">Fer Reserva</a>

<h1 class="text-center">Llistat de Reservas Inactives/Passades</h1>
<h3 class="text-center"><?php echo $params['resultat'] ?? "Resultat sense filtrar" ?></h3>

<table class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Taula</th>
            <th>Data</th>
            <th>Torn</th>
            <th>Número de Persones</th>
            <th>Observacions</th>
            <th>Usuari</th>
            <th>Ocupat</th>
            <th>Acció 1</th>
            <th>Acció 2</th>
            <th>Acció 3</th>
            <th>Acció 4</th>

        </tr>
    </thead>
    <tbody>
     
        
    <?php foreach ($params['llista'] as $reservation) : ?>
    <?php if (is_array($reservation) && $reservation['ocupat'] === false) : ?>
            <td><?php echo isset($reservation["id_reservation"]) ? $reservation["id_reservation"] : ''; ?></td>
            <td><?php echo isset($reservation["id_table"]) ? $reservation["id_table"] : ''; ?></td>
            <td><?php echo isset($reservation["date"]) ? $reservation["date"] : ''; ?></td>
            <td><?php echo isset($reservation["hour"]) ? $reservation["hour"] : ''; ?></td>
            <td><?php echo isset($reservation["n_pers_reservation"]) ? $reservation["n_pers_reservation"] : ''; ?></td>
            <td><?php echo isset($reservation["observations"]) ? $reservation["observations"] : ''; ?></td>
            <td><?php echo isset($reservation["username"]) ? $reservation["username"] : ''; ?></td>
            <td><?php echo isset($reservation["ocupat"]) ? ($reservation["ocupat"] ? 'si' : 'no') : ''; ?></td>
            <td><a href="/reservation/edit/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="btn btn-dark">Editar</a></td>
            <td><a href="/reservation/delete/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="btn btn-dark">Eliminar</a></td>
            <td>
                <a href="/reservation/changeState/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="<?php echo isset($reservation['ocupat']) ? ($reservation['ocupat'] ? 'btn btn-danger' : 'btn btn-success') : ''; ?>">
                    Canviar Estat (Act:<?php echo isset($reservation['ocupat']) ? ($reservation['ocupat'] ? 'ocupat' : 'lliure') : ''; ?>)
                </a>
            </td>
            <td>
                <a href="/reservation/liberate/?id_reservation=<?php echo isset($reservation['id_reservation']) ? $reservation['id_reservation'] : ''; ?>" class="btn btn-dark">Lliurar Reserva</a>
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>
    </tbody>
</table>

</body>

</html>