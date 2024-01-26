<?php
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
} ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Eliminar usuari</h1>
            <form action="/user/delete" method="post">
                <div class="mb-3">
                    <label for="id_user" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id_user" id="id_user" aria-describedby="helpId" placeholder="">
                    <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>