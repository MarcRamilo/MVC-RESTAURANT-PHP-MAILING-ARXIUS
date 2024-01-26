<?php

class reservationController extends Controller
{
    public function create()
    {
        $params['title'] = "Crear Reserva";
        $this->render("/reservation/create", $params, "site");
    }

    // $tableModel = new Table();
    // // $table = $tableModel->getFirstFreeTable();
    // if ($table !== null) {
    //     $tableModel->update($table['numero_taula'], true);
    //     $reservation['id_table'] = $table['numero_taula'];
    // } else {
    //     $_SESSION['missatge_flash'] = "No hi ha taules lliures";
    //     header("Location: /reservation/create");
    //     return;
    // }
    public function store()
{
    $reservationModel = new Reservation();
    $tableModel = new Table();

    $name_reservation = $_POST['name_reservation'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $n_pers_reservation = $_POST['n_pers_reservation'];
    $observations = $_POST['observations'];
    $username = $_POST['name_reservation'];
    $ocupat = true;
    $id_reservation = $_SESSION['id_reservation']++;

    if ($_POST['id_table'] != "") {
        $id_taula = $_POST['id_table'];
        
        $checkExistReservation = $reservationModel->checkIfDateIsFree($id_taula, $date, $hour);
        if (!$checkExistReservation) {
            $_SESSION['missatge_flash'] = "La taula ja esta reservada";
            header("Location: /reservation/create");
            return;
        }
        $tableModel->getFreeTableByIdAndTorn($id_taula, $hour);
        $tableModel->saveDataInTableInTorn($id_taula, $hour, $date);
        $tableModel->updateTable($id_taula, $hour);
        $idTaulaRandomFree = $id_taula;
    } else {
        //$day = date("Y-m-d", strtotime($date));
        $idTaulaRandomFree = $tableModel->getFreeTableByDateByTorn($hour, $date);

        if ($idTaulaRandomFree) {
            $tableModel->updateAllTable($idTaulaRandomFree, $hour, $date, $n_pers_reservation, $name_reservation, $id_reservation);
        } else {
            $_SESSION['missatge_flash'] = "No hi ha taules lliures";
            header("Location: /reservation/create");
            return;
        }
    }

    $reservation = array(
        "id_reservation" => $id_reservation,
        "name_reservation" => $name_reservation,
        "date" => $date,
        "hour" => $hour,
        "n_pers_reservation" => $n_pers_reservation,
        "observations" => $observations,
        "username" => $username,
        "ocupat" => $ocupat,
        "id_table" =>  $idTaulaRandomFree
    );

    $reservationModel->create($reservation);

    if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true) {
        header("Location: /reservation/list");
    } else {
        header("Location: /user/list");
    }
}

    public function list()
    {
        $params['title'] = "Llista de Reserves";
        $reservationModel = new Reservation();
        $params['llista'] = $reservationModel->getAll();
        $this->render("/reservation/list", $params, "site");
    }
    public function listByDayReservations()
    {
        $params['title'] = "Llista de Reserves";
        $reservationModel = new Reservation();
        $day = $_GET['day'];
        $params['llista'] = $reservationModel->getByDay($day);
        $params['resultat'] = "Llista de reserves del dia " . $day;
        $this->render("/reservation/list", $params, "site");
    }
    public function delete()
    {
        $id_reservation = $_GET['id_reservation'];
        $reservationModel = new Reservation();
        $reservationModel->delete($id_reservation);
        if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true) {
            header("Location: /reservation/list");
        } else {
            header("Location: /user/list");
        }
    }
    public function changeState()
    {
        $id_reservation = $_GET['id_reservation'];
        $reservationModel = new Reservation();
        $reservationModel->changeState($id_reservation);
        if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true) {
            header("Location: /reservation/list");
        } else {
            header("Location: /user/list");
        }
    }

    public function releaseTab()
    {
        $tableModel = new Table();
        $id_reservation = $_GET['id_table'];
        // comprovar si viene de la vista list de reservation si ve de la vosta listTab2
        $tableModel->updateTable($id_reservation, 1);
        header("Location: /table/list");
    }
    public function releaseTab2()
    {
        $tableModel = new Table();
        $id_reservation = $_GET['id_table'];
        // comprovar si viene de la vista list de reservation si ve de la vosta listTab2
        $tableModel->updateTable($id_reservation, 2);
        header("Location: /table/listTab2");
    }
    public function edit()
    {
        $reservationModel = new Reservation();
        $id_reservation = $_GET['id_reservation'];
        $reservation = $reservationModel->getById($id_reservation);
        $params['title'] = "Editar Reserva";
        $params['reservation'] = $reservation;
        $this->render("/reservation/edit", $params, "site");
    }

    public function update()
    {
        $reservationModel = new Reservation();
        $tableModel = new Table();
        $id_reservation = $_POST['id_reservation'];
        $date = $_POST['date'];
        $hour = $_POST['hour'];
        $n_pers_reservation = $_POST['n_pers_reservation'];
        $observations = $_POST['observations'];
        $username = $_POST['username'];
        $ocupat = true;
        $id_table = $_POST['id_table'];
        $reservation = array(
            "id_reservation" => $id_reservation,
            "date" => $date,
            "hour" => $hour,
            "n_pers_reservation" => $n_pers_reservation,
            "observations" => $observations,
            "username" => $username,
            "ocupat" => $ocupat,
            "id_table" =>  $id_table
        );
        $reservationModel->update($reservation);
        if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['admin'] === true) {
            header("Location: /reservation/list");
        } else {
            header("Location: /user/list");
        }
    }
    function change()
    {
        $reservationModel = new Reservation();
        $id_reservation = $_GET['id_reservation'];
        $reservation = $reservationModel->getById($id_reservation);
        $params['title'] = "Editar Reserva";
        $params['reservation'] = $reservation;
        $this->render("/reservation/change", $params, "site");
    }
    function updateObservations()
    {
        $id_reservation = $_POST['id_reservation'];
        $observations = $_POST['observations'];
        $reservation = array(
            "id_reservation" => $id_reservation,
            "observations" => $observations
        );

        if (isset($_SESSION['logged_user'])) {
            $reservationModel = new Reservation();
            $reservationModel->updateObservations($reservation);
            header("Location: /user/list");
        }
    }
    public function liberate()
    {
        //   1.poner estado de ocupat en reservation como false
        $reservationModel = new Reservation();
        $id_reservation = $_GET['id_reservation'];
        $reservationModel->liberate($id_reservation);
        // 2. Eliminar el ID de taula de la reserva
        $reservationModel->deleteIdTable($id_reservation);
        // 3. Actualizar el estado de la taula a false
        $tableModel = new Table();
        $tableModel->updateTable($id_reservation, 1);
        header("Location: /reservation/list");
    }
    public function viewNoActiveReservation(){
        $params['validate'] = true;
        $this->render("/table/viewReservationByTorn1", $params, "site");

    }
}
