<header>

</header>
<form action="/reservation/updateObservations" method="post" enctype="multipart/form-data">
    <div class="contingut m-4 p-4 col-5 mx-auto bg-light">
        <h1>Canvi d'Observacions</h1>
        <i class="text-center text-danger">Tens alguna pregunta, escriu-nos en el camp d'observacions (LES DADES DE LA RESERVA NO ES PODEN MODIFICAR)</i>

        <div class="mb-3">
            <label for="name_reservation" class="form-label">Usuari</label>
            <?php if ($_SESSION['logged_user']['admin'] === true) : ?>
                <select class="form-control" name="name_reservation" id="name_reservation" disabled>
                    <!-- Opciones del select aquí -->
                </select>
            <?php else : ?>
                <input type="text" class="form-control" readonly name="name_reservation" id="name_reservation" aria-describedby="helpId" placeholder="" value="<?php echo htmlspecialchars($_SESSION['logged_user']['username']) ?? "No t'has logejat"; ?>">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Data</label>
            <input type="date" class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $params["reservation"]["date"] ?? null; ?>">
            <div>
                <div class="mb-3">
                    <label for="hour" class="form-label">Torn Hora</label>
                    <input type="number" class="form-control" name="hour" id="hour" aria-describedby="helpId" placeholder="" min="1" max="2" value="<?php echo $params["reservation"]["hour"] ?? null; ?>">
                </div>
                <div class="mb-3">
                    <label for="n_pers_reservation" class="form-label">Num Persones</label>
                    <input type="number" class="form-control" name="n_pers_reservation" id="n_pers_reservation" aria-describedby="helpId" placeholder="" value="<?php echo $params["reservation"]["n_pers_reservation"] ?? null; ?>">
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="observations">Observacions</label>
                        <textarea class="form-control" id="observations" name="observations" rows="3"><?php echo ($params["reservation"]["observations"] ?? null); ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id_table" value="<?php echo $_GET['id_table'] ?? null ?>">
                <input type="hidden" name="id_reservation" value="<?php echo $_GET['id_reservation'] ?? null ?>">
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Desa Canvi</button>
                </div>
            </div>
        </div>
</form>