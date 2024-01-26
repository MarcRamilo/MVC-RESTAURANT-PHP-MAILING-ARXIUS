<header>

</header>
<form action="/reservation/store" method="post" enctype="multipart/form-data">
  <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
    <h1>Reserva Taula</h1>
    <i>Per reservar taula hi han dos trons 1 a les 13:00 i el 2 a les 14:15</i>
    <div class="mb-3">
            <label for="name_reservation" class="form-label">User</label>
            <?php if ($_SESSION['logged_user']['admin'] === true): ?>
                <select class="form-control" name="name_reservation" id="name_reservation">
                    <option value="">Selecciona un usuari</option>
                    <?php
                    $userModel = new User();
                    $userList = $userModel->getAll();
                    foreach ($userList as $user):
                    ?>
                        <option value="<?php echo $user['username']; ?>"><?php echo $user['username']; ?></option>
                    <?php endforeach; ?>
                   
                </select>
            <?php else: ?>
              <input type="text" class="form-control" readonly name="name_reservation" id="name_reservation" aria-describedby="helpId" placeholder="" value="<?php echo isset($_SESSION['logged_user']['username']) ? htmlspecialchars($_SESSION['logged_user']['username']) : "No t'has logejat"; ?>">
            <?php endif; ?>
        </div>
    <div class="mb-3">
      <label for="date" class="form-label" >Date</label>
      <input type="date" class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="" min="<?php echo date('Y-m-d'); ?>">
      <div>
        <div class="mb-3">
          <label for="hour" class="form-label">Torn Hora</label>
          <input type="number" class="form-control" name="hour" id="hour" aria-describedby="helpId" placeholder="" min="1" max="2">
        </div>
        <div class="mb-3">
          <label for="n_pers_reservation" class="form-label">Num Persones</label>
          <input type="number" class="form-control" name="n_pers_reservation" id="n_pers_reservation" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <div class="form-group">
            <label for="observations">Observacions</label>
            <textarea class="form-control" id="observations" name="observations" rows="3"></textarea>
          </div>
        </div>
        <input type="hidden" name="id_table" value="<?php echo $_GET['id_table'] ?? null ?>">
        <div class="mb-3">
          <button type="submit" class="btn btn-primary">Desa</button>
        </div>
      </div>
</form>
</div>