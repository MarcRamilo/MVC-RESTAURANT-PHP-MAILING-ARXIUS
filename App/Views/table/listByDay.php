<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $params['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-cell {
            width: 150px;
            height: 150px;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }
        .table-cell.ocupada {
            background-color: #FF0000;
        }
        .table-cell.lliure {
            background-color: #00FF00;
        }
    </style>
</head>
<div class="container mt-4">
    <form action="/table/listByDay" method="post" class="mb-3">
        <label for="day" class="form-label">Selecciona un día:</label>
        <input type="date" class="form-control" name="day" id="day" value="<?php echo date('Y-m-d'); ?>" min = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")));?>">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
        
    <h1 class="text-center"><?php echo $params['title'] ?></h1>
    <a href="/table/list" class="btn btn-primary d-flex justify-content-center" >Canviar Torn</a>
    
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Taula</th>
                <?php for ($i = 1; $i <= 8; $i++): ?>
                    <th><?php echo $i; ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($j = 1; $j <= 6; $j++): ?>
                <tr>
                    <th scope="row"><?php echo $j; ?></th>
                    <?php for ($i = 1; $i <= 8; $i++): ?>
                        <?php
                            $idTaula = ($j - 1) * 8 + $i;
                            $ocupada = isset($params['tableStatus'][$idTaula]) ? $params['tableStatus'][$idTaula] : false;
                            $clase = $ocupada ? 'ocupada' : 'lliure';
                        ?>
                        <td class="table-cell <?php echo $clase; ?>">
                            <p>Taula <?php echo $idTaula; ?></p>
                            <p><?php echo $ocupada ? 'Ocupada' : 'Lliure'; ?></p>
                            <!-- Afegir reserva a taula -->
                            <a href="/reservation/create/?id_table=<?php echo $idTaula; ?>" class="btn btn-primary">Reservar</a>
                            <!-- Lliurar taula -->
                            <a href="/reservation/delete/?id_table=<?php echo $idTaula; ?>" class="btn btn-danger">Lliurar</a>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</div>
</html>
