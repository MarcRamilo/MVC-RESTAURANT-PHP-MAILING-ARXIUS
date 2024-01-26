<form action="/user/store" method="post" enctype="multipart/form-data">
  <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
    <h1>SignUp</h1>
    <?php if (isset($_SESSION['logged_user']['admin'] ) === true): ?>
      <div class="mb-3">
        <label for="admin" class="form-label">Role</label>
        <select class="form-control" name="admin" id="admin">
          <option value="">Selecciona un rol</option>
          <option value="admin">Admin</option>
          <option value="client">Client</option>
        </select>
      </div>
    <?php endif; ?>
    <div class="mb-3">
      <label for="username" class="form-label" enctype="multipart/form-data" >Username</label>
      <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="Insereix un nou nom d'Usuari" value="<?php echo $_POST['username']  ?? null; ?>">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Insereix un nou nom" value="<?php echo $_POST['name']  ?? null; ?>">
    </div>
    <div class="mb-3">
      <label for="mail" class="form-label">Mail</label>
      <input type="text" class="form-control" name="mail" id="mail" aria-describedby="helpId" placeholder="Insereix un nou Mail" value="<?php echo $_POST['mail']  ?? null; ?>">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="mb-3">
      <label for="profile_image" class="form-label">Profile Image</label>
      <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*" required>
    </div>
    <div class="mb-3">
      <label for="pass" class="form-label">Password</label>
      <input type="password" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="Insereix una nova contrassenya" value="<?php echo $_POST['pass']  ?? null; ?>">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div>
      <div class="mb-3">
        <input type="checkbox" class="form-check-label" name="avisLegalDades" id="avisLegalDades" aria-describedby="helpId"  />
        <label for="avisLegalDades" class="form-label">Avis Legal de Dades</label>
      </div>
    </div>
    <div class="mb-3">
      <input type="checkbox" class="form-check-label" name="avisEnviamentPropaganda" id="avisEnviamentPropaganda" aria-describedby="helpId" />
      <label for="avisEnviamentPropaganda" class="form-label">Estàs interessat en rebre promoció?</label>
      <p>T'has logejat? <a href="/user/index" class="">Logeja't</a></p>

    </div>
    <button type="submit" class="btn btn-primary">Desa</button>

  </div>
</form>
</div>