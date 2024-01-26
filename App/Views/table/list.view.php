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
            background-color: white;
        }

        .table-cell.lliure {
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
     


        <h1 class="text-center"><?php echo $params['title'] ?></h1>
        <a href="/table/listTab2" class="btn btn-primary d-flex justify-content-center">Canviar Torn</a>
        <a href="/table/viewReservationByTorn1" class="btn btn-info d-flex justify-content-center">Veure Reserves Associades</a>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Taula</th>
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <th><?php echo $i; ?></th>
                    <?php endfor; ?>
                </tr>
            </thead>
            <tbody>
    <?php for ($j = 1; $j <= 6; $j++) : ?>
        <tr>
            <th scope="row"><?php echo $j; ?></th>
            <?php for ($i = 1; $i <= 8; $i++) : ?>
                <?php
                // Calculate the index based on the row and column
                $tableIndex = ($j - 1) * 8 + $i - 1;
                
                // Check if the index is within the range of available tables
                if (isset($params['llista'][$tableIndex])) {
                    $table = $params['llista'][$tableIndex];
                    $idTaula = $table['id'] ?? null;
                    $nom = $table['name_reservation'] ?? null;
                    $ocupada = $table['ocupat'];
                    $clase = $ocupada ? 'ocupada' : 'lliure';
                } else {
                    $idTaula = null;
                    $nom = null;
                    $ocupada = false;
                    $clase = 'lliure'; // Default to 'lliure' if no reservation
                }
                ?>
                <td class="table-cell <?php echo $clase; ?>">
                    <?php if ($idTaula !== null) : ?>
                        <p>Taula <?php echo $idTaula; ?></p>
                        <p><?php //echo $ocupada ? 'Ocupada' : 'Lliure'; ?></p>
                        <p> <?php //echo $nom ?? ''; ?></p>
                        <!-- Afegir reserva a taula -->
                        <a href="/reservation/create/?id_table=<?php echo $idTaula ?? ''; ?>" class="btn btn-primary">Reservar</a>
                        <!-- Lliurar taula -->
                        <!-- <a href="/reservation/releaseTab/?id_table=<?php echo $idTaula ?? ''; ?>" class="btn btn-danger"><?php echo $ocupada ? 'Lliurar' : 'Ocupar'; ?></a> -->
                    <?php endif; ?>
                </td>
            <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</body>

</html>