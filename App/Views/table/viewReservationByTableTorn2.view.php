
<h1 class="text-center">RESERVES PEL TORN 2</h1>
<h3>Filtrar per data</h3>
<form action="/table/listByDayListTab2/" method="get" class="mb-3">
    <label for="day" class="form-label">Selecciona un día:</label>
    <input type="date" class="form-control" name="day" id="day" value="<?php echo date('Y-m-d'); ?>" min = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")));?>">
    <button type="submit" class="btn btn-primary">Filtrar</button>
</form>
<h3>Filtrar per data</h3>


<table class="table table-striped table-bordered text-center">
    <tr>
        <th>ID Reserva</th>
        <th>Data</th>
        <th>Torn</th>
        <th>Número persones</th>
        <th>Observacions</th>
        <th>Usuari</th>
        <th>Estat</th>
        <th>Id Taula</th>
        <th>Accion1</th>
        <th>Accion2</th>
    </tr>
  
    <?php foreach ($params['llista'] as $reservation) : ?>
        <?php if ($reservation['ocupat'] === true) { ?>
        <tr>
            <td><?= $reservation['id_reservation'] ?></td>
            <td><?= $reservation['date'] ?></td>
            <td><?= $reservation['hour'] ?></td>
            <td><?= $reservation['n_pers_reservation'] ?></td>
            <td><?= $reservation['observations'] ?></td>
            <td><?= $reservation['username'] ?></td>
            <td><?= $reservation['ocupat'] ? "Ocupat" : "Lliure" ?></td>
            <td><?= $reservation['id_table'] ?></td>
            <td>
                <a href="/reservation/edit/?id_reservation=<? echo $reservation['id_reservation'] ?>" class="btn btn-primary">Editar</a>
              
            </td>
            <td>
            <a href="/reservation/delete/?id_reservation=<? echo $reservation['id_reservation'] ?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    <?php endforeach ?>
</table>