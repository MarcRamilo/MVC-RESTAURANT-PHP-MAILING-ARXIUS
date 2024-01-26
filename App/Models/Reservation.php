<?php

include_once("Orm.php");

class Reservation extends Orm
{
    public function __construct()
    {
        parent::__construct('reservations');
        if (!isset($_SESSION['id_reservation'])) {
            $_SESSION['id_reservation'] = 1;
        }
    }

    public function delete($id_reservation)
    {
        foreach ($_SESSION[$this->model] as $key => $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_reservation'] == $id_reservation) {
                unset($_SESSION[$this->model][$key]);
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getAll()
    {
        return $_SESSION[$this->model];
    }

    public function getById($id_reservation)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_reservation'] == $id_reservation) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByUsername($username)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['username'] == $username) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByDate($date)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['date'] == $date) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByHour($hour)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['hour'] == $hour) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByNpers($n_pers_reservation)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['n_pers_reservation'] == $n_pers_reservation) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByObservations($observations)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['observations'] == $observations) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByOcupat($ocupat)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['ocupat'] == $ocupat) {
                return $_SESSION['reservation'];
            }
        }
        return null;
    }

    public function getByTable($id_table)
    {
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_table'] == $id_table) {
                return $_SESSION['reservation'];
            }
        }
    }

    public function changeState()
    {
        $id_reservation = $_GET['id_reservation'];
        foreach ($_SESSION[$this->model] as $key => $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_reservation'] == $id_reservation) {
                $_SESSION[$this->model][$key]['ocupat'] = !$_SESSION[$this->model][$key]['ocupat'];
                return $_SESSION[$this->model][$key];
            }
        }
        return null;
    }
    public function update()
    {
        $id_reservation = $_POST['id_reservation'];
        $date = $_POST['date'];
        $hour = $_POST['hour'];
        $n_pers_reservation = $_POST['n_pers_reservation'];
        $observations = $_POST['observations'];
        $username = $_POST['username'];
        $ocupat = true;
        $id_taula = $_POST['id_table'];
        $reservation = array(
            "id_reservation" => $id_reservation,
            "date" => $date,
            "hour" => $hour,
            "n_pers_reservation" => $n_pers_reservation,
            "observations" => $observations,
            "username" => $username,
            "ocupat" => $ocupat,
            "id_table" =>  $id_taula
        );
        foreach ($_SESSION[$this->model] as $key => $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_reservation'] == $id_reservation) {
                $_SESSION[$this->model][$key] = $reservation;
                return $_SESSION[$this->model][$key];
            }
        }
        return null;
    }
    public function getByDay($day)
    {
        $reservationsForDay = array();

        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['date'] == $day) {
                $reservationsForDay[] = $_SESSION['reservation'];
            }
        }

        return $reservationsForDay;
    }
    public function updateObservations($reservation)
    {
        $id_reservation = $reservation['id_reservation'];
        $observations = $reservation['observations'];

        foreach ($_SESSION[$this->model] as $key => $sessionReservation) {
            if ($sessionReservation['id_reservation'] == $id_reservation) {
                $_SESSION[$this->model][$key]['observations'] = $observations;
                return $_SESSION[$this->model][$key];
            }
        }

        return null;
    }
    public function getReservationByTorn1()
    {
        $reservationsForTorn1 = array();
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['hour'] == "1") {
                $reservationsForTorn1[] = $_SESSION['reservation'];
            }
        }
        return $reservationsForTorn1;
    }
    public function getReservationByTorn2()
    {
        $reservationsForTorn1 = array();
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['hour'] == "2") {
                $reservationsForTorn1[] = $_SESSION['reservation'];
            }
        }
        return $reservationsForTorn1;
    }
    public function liberate()
    {
        $id_reservation = $_GET['id_reservation'];
        foreach ($_SESSION[$this->model] as $key => $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_reservation'] == $id_reservation) {
                $_SESSION[$this->model][$key]['ocupat'] = false;
                return $_SESSION[$this->model][$key];
            }
        }
        return null;
    }
    public function deleteIdTable($id)
    {
        foreach ($_SESSION[$this->model] as $key => $_SESSION['reservation']) {
            if ($_SESSION['reservation']['id_reservation'] == $id) {
                $_SESSION[$this->model][$key]['id_table'] = null;
                return $_SESSION[$this->model][$key];
            }
        }
        return null;
    }
    public function getReservationByDayTorn1($day, $torn)
    {
        $reservationsForDay = array();
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['date'] == $day && $_SESSION['reservation']['hour'] == $torn) {
                $reservationsForDay[] = $_SESSION['reservation'];
            }
        }
        return $reservationsForDay;
    }
    public function getReservationByDayTorn2($day, $torn)
    {
        $reservationsForDay = array();
        foreach ($_SESSION[$this->model] as $_SESSION['reservation']) {
            if ($_SESSION['reservation']['date'] == $day && $_SESSION['reservation']['hour'] == $torn) {
                $reservationsForDay[] = $_SESSION['reservation'];
            }
        }
        return $reservationsForDay;
    }
    public function checkIfDateIsFree($id_taula, $date, $hour)
    {
        $reservationModel = new Reservation();
        $reservations = $reservationModel->getAll(); 
    
        foreach ($reservations as $reservation) {
            if ($reservation['id_table'] == $id_taula && $reservation['date'] == $date && $reservation['hour'] == $hour) {
                return false; 
            }
        }
    
        return true; 
    }
}
