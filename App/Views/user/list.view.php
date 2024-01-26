<?php
$currentDate = date('Y-m-d');
?>
<title><?php echo $params['title'] ?></title>
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === false) { ?>
                <div class="m-4 p-4 col-5 mx-auto ">
                    <h2>Benvingut <?php echo $_SESSION['logged_user']['name']; ?> <!--(Rol: <?php //echo $_SESSION['logged_user']['role']; 
                                                                                            ?>)--></h2>
                </div>
                <div class="m-4 p-4 col-5 mx-auto ">
                    <h3>Informació de l'usuari</h3>
                </div>

                <table class="table table-striped">
                    <thead>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Mail</th>
                        <th>Profile Image</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Avis Legal</th>
                        <th>Acceptació Enviament Propaganda</th>
                        <th>Verificat</th>
                        <th>Acció</th>
                        <th>Chat amb Restaurant</th>
                    </thead>
                    <tbody>
                        <th> <?php echo $_SESSION['logged_user']['username']; ?></th>
                        <th><?php echo $_SESSION['logged_user']['name']; ?></th>
                        <th> <?php echo $_SESSION['logged_user']['mail']; ?></th>
                        <th> <img src="../../../Public/Assets/images/profile_images/<?php echo $_SESSION['logged_user']['username']; ?>.jpg" alt="Perfil de <?php echo $_SESSION['logged_user']['username']; ?>" class="img-fluid" style="max-width: 200px;"></th>
                        <th> <?php echo $_SESSION['logged_user']['admin'] ? 'admin' : 'client'; ?></th>
                        <th> <?php echo $_SESSION['logged_user']['pass']; ?></th>
                        <th> <?php echo $_SESSION['logged_user']['avisLegalDades'] ? 'si' : 'no'; ?></th>
                        <th> <?php echo $_SESSION['logged_user']['avisEnviamentPropaganda'] ? 'si' : 'no'; ?></th>
                        <th> <?php echo $_SESSION['logged_user']['verified'] ? 'si' : 'no'; ?></th>
                        <td><a href="/user/edit/?id_user=<?php echo $_SESSION['logged_user']['username']; ?>" class="btn btn-primary">Editar</a></td>
                        <td><a href="/user/chat/?id_user=<?php echo $_SESSION['logged_user']['username']; ?>" class="btn btn-success">Chat</a></td>
                    </tbody>
                </table>
                <table class="table table-striped">
                    <div class="m-4 p-4 col-5 mx-auto ">
                        <h3>Reserves Actives</h3>
                    </div>
                    <thead>
                        <tr>
                            <th>Identificador de la Reserva</th>
                            <th>Nom de reserva</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Num Persones</th>
                            <th>Observacions</th>
                            <th>Estat</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($params['reservations'])) {
                            foreach ($params['reservations'] ?? null as $r) {
                                if ($r['username'] === $_SESSION['logged_user']['username'] && $r['date'] >= $currentDate && $r['ocupat'] === true) {

                        ?>
                                    <tr>
                                        <td><?php echo $r['id_reservation'] ?? null; ?></td>
                                        <td><?php echo $r['username'] ?? null; ?></td>
                                        <td><?php echo $r['date'] ?? null; ?></td>
                                        <td><?php echo $r['hour'] ?? null; ?></td>
                                        <td><?php echo $r['n_pers_reservation'] ?? null; ?></td>
                                        <td><?php echo $r['observations'] ?? null; ?></td>
                                        <td><?php echo $r['ocupat'] ? 'Activa' : 'Passada' ?></td>
                                        <td>
                                            <a href="/reservation/change/?id_reservation=<?php echo $r['id_reservation']; ?>" class="btn btn-primary">Sol·licitar canvi reserva</a>
                                            <a href="/reservation/delete/?id_reservation=<?php echo $r['id_reservation']; ?>" class="btn btn-danger">Anul·lar reserva</a>
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <table class="table table-striped">
                    <div class="m-4 p-4 col-5 mx-auto  ">
                        <h3>Reserves passades</h3>
                    </div>
                    <thead>
                        <tr>
                            <th class="text-secondary">Identificador de la Reserva</th>
                            <th class="text-secondary">Nom de reserva</th>
                            <th class="text-secondary">Data</th>
                            <th class="text-secondary">Hora</th>
                            <th class="text-secondary">Num Persones</th>
                            <th class="text-secondary">Observacions</th>
                            <th class="text-secondary">Estat</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (isset($params['reservations'])) {
                            foreach ($params['reservations'] ?? null as $r) {
                                if ($r['username'] === $_SESSION['logged_user']['username'] && $r['ocupat'] === false) {

                        ?>
                                    <tr>
                                        <td class="text-secondary"><?php echo $r['id_reservation'] ?? null; ?></td>
                                        <td class="text-secondary"><?php echo $r['username'] ?? null; ?></td>
                                        <td class="text-secondary"><?php echo $r['date'] ?? null; ?></td>
                                        <td class="text-secondary"><?php echo $r['hour'] ?? null; ?></td>
                                        <td class="text-secondary"><?php echo $r['n_pers_reservation'] ?? null; ?></td>
                                        <td class="text-secondary"><?php echo $r['observations'] ?? null; ?></td>
                                        <td class="text-secondary"><?php echo $r['ocupat'] ? 'Activa' : 'Passada' ?></td>

                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else if ((isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true)) { ?>
                <h1>Llista d'usuaris</h1>
                <table class="table table-striped text-">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Mail</th>
                            <th>Profile Image</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Avis Legal</th>
                            <th>Acceptació EnviamentPropaganda</th>
                            <th>Verificat</th>
                            <th>Acció 1</th>
                            <th>Acció 2</th>
                            <th>Acció 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($params['llista'] as $u) { ?>
                            <tr>
                                <td><?php echo $u['username'] ?></td>
                                <td><?php echo $u['name'] ?></td>
                                <td><?php echo $u['mail'] ?></td>
                                <td>
                                <img src="../../../Public/Assets/images/profile_images/<?php echo $u['username']; ?>.jpg" alt="Perfil de <?php echo $u['username']; ?>" class="img-fluid" style="max-width: 200px;">
                                </td>
                                <td><?php echo $u['admin'] ? 'admin' : 'client'; ?> </td>
                                <td><?php echo $u['pass'] ?></td>
                                <td><?php echo $u['avisLegalDades'] ? 'si' : 'no'; ?> </td>
                                <td><?php echo $u['avisEnviamentPropaganda'] ? 'si' : 'no'; ?> </td>
                                <td><?php echo isset($u['verified']) && $u['verified'] ? 'si' : 'no'; ?> </td>
                                <?php if (isset($u['username']) && $u['username'] === 'admin') : ?>
                                    <td> <?php echo "No pots editar l'usuari admin"; ?> </td>
                                    <td> <?php echo "No pots eliminar l'usuari admin"; ?> </td>
                                <?php else : ?>
                                    <td><a href="/user/edit/?id_user=<?php echo $u['username']; ?>" class="btn btn-primary">Editar</a></td>
                                    <td><a href="/user/delete/?id_user=<?php echo $u['username']; ?>" class="btn btn-danger">Eliminar</a></td>
                                    <td><a href="/user/chatAdmin/?id_user=<?php echo $u['username']; ?>" class="btn btn-success">Chat</a></td>

                                <?php endif; ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="/user/create" class="btn btn-primary">Crear usuari</a>
            <?php } ?>
        </div>
    </div>
</div>