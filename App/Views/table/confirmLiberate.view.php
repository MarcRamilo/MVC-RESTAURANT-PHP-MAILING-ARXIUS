<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Lliberació</title>
</head>

<body>
    <h1 class="text-center">Confirmar Lliberació</h1>
    <p>Segur que vols lliberar aquesta taula per la data selecionada?</p>
    <form action="/table/confirmLiberate" method="post">
        <input type="hidden" name="id_table" value="<?php echo $params['id']; ?>">


        <label for="date_to_delete">Selecciona la data:</label>
        <select name="date_to_delete" id="date_to_delete">
            <?php foreach ($params['dates'] as $date) : ?>
                <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
            <?php endforeach; ?>
        </select>
        <!-- printar info de la reserva filtrando la mesa -->

        <button type="submit" class="btn btn-danger">Sí, lliurar taula</button>
        <a href="/table/listTables" class="btn btn-primary">Rebutjar</a>
    </form>
    <p>Info de la reserva:</p>
    <p>ID Reserva: <?php echo $params['reservation']['id_reservation']; ?></p>
    <p>Data: <?php echo $params['reservation']['date']; ?></p>
    <p>Torn: <?php echo $params['reservation']['hour']; ?></p>
    <p>Número de Persones: <?php echo $params['reservation']['n_pers_reservation']; ?></p>
    <p>Observacions: <?php echo $params['reservation']['observations']; ?></p>
    <p>Usuari: <?php echo $params['reservation']['username']; ?></p>
    <p>Ocupat: <?php echo $params['reservation']['ocupat'] ? 'si' : 'no'; ?></p>
    <p>Id Taula: <?php echo $params['reservation']['id_table']; ?></p>

</body>

</html>