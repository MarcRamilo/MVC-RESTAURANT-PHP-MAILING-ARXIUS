<!doctype html>
<html lang="en">
<?php 
if (isset($_SESSION['missatge_flash'])) {
    echo "<div class='alert alert-" . ($_SESSION['missatge_flash'] === "Login correcte" ? "success" : "danger") . "'>" . $_SESSION['missatge_flash'] . "</div>";
    unset($_SESSION['missatge_flash']);
}
?>
<head>
  <title><?php echo $params['title'] ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <nav class="py-3 px-2 bg-primary text-white h4 d-flex justify-content-between">
    <div class="left">
      <i class="bi bi-calendar-week">Restaurant</i>
    </div>
    <div class="right">
      <?php if(isset($_SESSION['logged_user'])) {?>
        <a href="/user/logout" class="text-white text-decoration-none">LogOut</a>
        <a href="/user/list" class="text-white text-decoration-none"><?php echo $_SESSION['logged_user']['name'] ?></a>
      <?php } else{?>
      <a href="/user/create" class="text-white text-decoration-none">SignUp</a>
      <a href="/user/index" class="text-white text-decoration-none">Login</a>
      <?php } ?>
      <?php 
        $link_admin_home = "/user/admin";
        $link_user_home = "/user/home";
      
      ?>
      <a href=" <?php echo $link_user_home?>" class="text-white text-decoration-none">Home</a>
      <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true) {?>
      <a href="/user/admin" class="text-white text-decoration-none">Admin</a>
      <?php }  ?>
    </div>
  </nav>
</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

    <?php echo $params['content'] ?>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>