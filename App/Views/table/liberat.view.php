<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lliberar Taula per Data</title>
</head>

<body>

    <h1 class="text-center">Lliberar Taula per Data</h1>

    <form action="/table/confirmLiberate" method="post" class="mb-3">
        <input type="hidden" name="id_table" value="<?php echo $params['id_table']; ?>">
        
        <label for="liberation_date" class="form-label">Selecciona la data de liberació:</label>
        <input type="date" class="form-control" name="liberation_date" id="liberation_date" required>
        
        <button type="submit" class="btn btn-primary">Confirmar Liberació</button>
    </form>

    <a href="/table/listTables" class="btn btn-secondary">Tornar a la llista de taules</a>

</body>

</html>