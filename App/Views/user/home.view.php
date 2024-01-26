<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvingut/da al nostre restaurant </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="bg-dark text-white text-center py-5">
        <h1 class="display-4">Benvingut/da al nostre restaurant <?php echo $_SESSION['logged_user']['name'] ?? 'convidat'; ?></h1>
    </header>

    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h2 class="mb-4">Descobreix la nostra exquisida cuina</h2>
                <p class="lead">
                    Benvingut al nostre restaurant, on et convidem a gaudir d'una experiència culinària única.
                    Amb ingredients frescos i plats deliciosos, estem dedicats a oferir-te una experiència gastronòmica
                    inoblidable. Vine i descobreix els nostres sabors exquisits.
                </p>
                <img src="https://media.istockphoto.com/id/1018141890/es/foto/copas-de-vino-vac%C3%ADas-dos-sentados-en-un-restaurante-en-una-c%C3%A1lida-tarde-soleada.jpg?s=612x612&w=0&k=20&c=ykP_wg0GFiEgpvpD-0-AWJT3Pt0_bAvhiwe7Vwu-3KQ=" class="img-fluid mx-auto" alt="Imatge del restaurant">
            </div>
        </div>
    </section>


    <div class="container mt-4 ">
        <br>
        <h3 class="d-flex justify-content-center bd-highlight mb-3">Vols fer una reserva?</h3>
        <?php
        $link_logged = "/reservation/create";
        $link_guest = "/user/index";
        ?>
        <br>
        <a href="<?php echo isset($_SESSION['logged_user']) ? $link_logged : $link_guest  ?>" class="btn btn-primary d-flex justify-content-center ">Reservar</a>
        <br>
        <?php
        $link_logged_chat = "/user/chat";
        $link_guest_chat = "/user/index";
        ?>
        <br>
        <a href="<?php echo isset($_SESSION['logged_user']) ? $link_logged_chat : $link_guest_chat  ?>" class="btn btn-success d-flex justify-content-center ">Chat amb el Restaurant</a>
        <br>
        

    </div>


    <footer class="bg-dark text-white text-center py-3 mt-4">
        &copy; <?php echo date('Y'); ?> Nostre Restaurant
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>