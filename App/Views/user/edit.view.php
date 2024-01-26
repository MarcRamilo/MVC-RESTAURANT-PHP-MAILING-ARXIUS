<form action="/user/storeEditUser" method="post" enctype="multipart/form-data">
  <div class="contingut m-4 p-4 col-5 mx-auto bg-light ">
    <h1>Edit User <?php echo  $params['user']['name'] ?> </h1>
    <?php if ($_SESSION['logged_user']['admin'] === true) : ?>
      <div class="mb-3">
        <label for="admin" class="form-label">Role</label>
        <select class="form-control" name="admin" id="admin">
          <option value="<?php echo $params['user']['admin'] ?>"><?php echo $params['user']['admin'] ? "Admin" : "Client" ?></option>
          <option value="admin">Admin</option>
          <option value="client">Client</option>
        </select>
      </div>
    <?php endif; ?>
    <div class="mb-3">

      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="username" id="username" aria-describedby="helpId" placeholder="" value="<?php echo $params['user']['username'] ?>">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <?php if ($_SESSION['logged_user']['admin'] === false) : ?>

    <div class="mb-3">
      <label>Imatge Acutal</label>
      <img src="../../../Public/Assets/images/profile_images/<?php echo $params['user']['username']; ?>.jpg" alt="Perfil de <?php echo $params['user']['username']; ?>" class="img-fluid" style="max-width: 200px;">
      <br>
      <label for="profile_image" class="form-label">Change Profile Image</label>
      <input type="file" class="form-control" name="profile_image" id="profile_image">
    </div>
    <?php endif; ?>

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="" value="<?php echo $params['user']['name'] ?>">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="mb-3">
      <label for="mail" class="form-label">Mail</label>
      <input type="text" class="form-control" name="mail" id="mail" aria-describedby="helpId" placeholder="" value="<?php echo  $params['user']['mail'] ?>">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div class="mb-3">
      <label for="pass" class="form-label">Password</label>
      <input type="password" class="form-control" name="pass" id="pass" aria-describedby="helpId" placeholder="">
      <small id="helpId" class="form-text text-muted">Help text</small>
    </div>
    <div>
      <div class="mb-3">
        <input type="checkbox" class="form-check-label" name="avisEnviamentPropaganda" id="avisEnviamentPropaganda" aria-describedby="helpId" checked />
        <label for="avisEnviamentPropaganda" class="form-label">Estàs interessat en rebre promoció?</label>

      </div>

    </div>
    <button type="submit" class="btn btn-primary">Desa</button>

  </div>
</form>
</div>