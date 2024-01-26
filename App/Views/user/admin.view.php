<br>
<div class="d-flex justify-content-center bd-highlight mb-3">
    <h2>Benvingut <?php echo $_SESSION['logged_user']['name'] ?> amb rol <?php echo $_SESSION['logged_user']['admin'] ? 'admin' : 'client'; ?></h2>
</div>
<br>
<div class="d-flex justify-content-center bd-highlight mb-3">
    <h3>Què vols fer?</h3>
</div>
<br>
<br>
<div class="d-flex justify-content-center bd-highlight mb-3">
    <a href="/reservation/list" class="btn btn-primary mx-3">Gestionar reserves</a>
    <a href="/user/list" class="btn btn-primary mx-3">Gestionar Usuaris</a>
    <a href="/table/list" class="btn btn-primary mx-3">Gestionar Taules Restaurant</a>
    <!-- <a href="/table/listTables" class="btn btn-primary mx-3">Vista llista Taules</a> -->
</div>
