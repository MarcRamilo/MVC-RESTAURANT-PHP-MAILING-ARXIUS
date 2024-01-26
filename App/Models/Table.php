<?php
include_once("Orm.php");

class Table extends Orm
{
    // private $id_taula;
    // private $data_reserva;
    // private $numero_persones;
    // private $torn;
    // private $ocupat;

    public function __construct()
    {
        parent::__construct('table');
        if (!isset($_SESSION['id_table'])) {
            $_SESSION['id_table'] = 1;
        }


        if (!isset($_SESSION[$this->model])) {
            $_SESSION[$this->model] = [];
        }

        if (!isset($_SESSION[$this->model . '_turn1'])) {
            $this->loadTableForTurn1();
        }
        if (!isset($_SESSION[$this->model . '_turn2'])) {
            $this->loadTableForTurn2();
        }
    }
    public function loadTableForTurn1()
    {
        $tableData = $this->generateTableData(8, 6, 1);
        $_SESSION[$this->model . '_turn1'] = $tableData;
    }

    public function loadTableForTurn2()
    {
        $tableData = $this->generateTableData(8, 6, 2);
        $_SESSION[$this->model . '_turn2'] = $tableData;
    }

    private function generateTableData($rows, $columns, $turn)
    {
        $tableData = [];

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $tableData[] = [
                    'id' => $i * $columns + $j,
                    'data_reserva' => '', 
                    'numero_persones' => '',
                    'torn' => $turn,
                    'ocupat' => true,
                    'user' => [],
                    'id_reservation'=>'',
                ];
            }
        }

        $_SESSION[$this->model] = $tableData;
        return $tableData;
    }


    public function getTableById($id)
    {
        foreach ($_SESSION[$this->model] as $table) {
            if ($table['id'] == $id) {
                return $table;
            }
        }
        return null;
    }
    public function getFirstFreeTableId()
    {
        foreach ($_SESSION[$this->model] as $table) {
            if (!$table['ocupat']) {
                return $table['id'];
            } else {
                return null;
            }
        }
        return null;
    }
    public function putOcupatTable($id, $torn)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['id'] == $id) {
                $table['ocupat'] = true;
                return $table;
            }
        }
        return null;
    }
    public function updateStateTableByIdTorn($id, $torn)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['id'] == $id) {
                $table['ocupat'] = true;
                return $table;
            }
        }
        return null;
    }

    public function update($id, $ocupat)
    {
        $table = $this->getById($id);

        if ($table) {
            $table['ocupat'] = $ocupat;
            $this->updateItemById($id, $table);
            $_SESSION[$this->model][$id] = $table;
        }
    }

    // public function getTablesByDay($day,$torn)
    // {
    //     $taules = [];
    //     foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
    //         if ($table['data_reserva'] == $day) {
    //             $taules[] = $table;
    //         }
    //     }
    //     return $taules;
    // }
    public function liberateTable($id, $torn, $dateToDelete)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $key => &$table) {
            if ($table['id'] == $id) {
                $index = array_search($dateToDelete, $table['data_reserva']);
                if ($index !== false) {
                    unset($table['data_reserva'][$index]);
                }

                if (empty($table['data_reserva'])) {
                    $table['ocupat'] = false;
                }

                return $table;
            }
        }
        return null;
    }
    public function getTablesByDay($day, $torn)
    {
        $taules = [];
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if (is_array($table['data_reserva']) && in_array($day, $table['data_reserva'])) {
                $taules[] = $table;
            }
        }
        return $taules;
    }
    public function getTableStatusById($id)
    {
        $table = $this->getById($id);
        if ($table) {
            return $table['ocupat'];
        }
        return null;
    }
    public function getTableDates($id, $torn)
    {
        $table = $this->getTableByIdAndTorn($id, $torn);

        if ($table) {
            return $table['data_reserva'];
        }

        return [];
    }

    public function getTableByIdAndTorn($id, $torn)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['id'] == $id) {
                return $table;
            }
        }

        return null;
    }

    public function getAll()
    {
        return $_SESSION[$this->model];
    }
    public function getAllTorn1()
    {
        return $_SESSION[$this->model . '_turn1'];
    }
    public function getAllTorn2()
    {
        return $_SESSION[$this->model . '_turn2'];
    }

    public function getTableByTorn($torn)
    {
        $taules = [];
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['torn'] == $torn) {
                $taules[] = $table;
            }
        }


        return $taules;
    }
    public function getFreeTableByIdAndTorn($id, $torn)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['id'] == $id && $table['ocupat'] == false) {
                return $table;
            }
        }
        return null;
    }
    public function getFreeTableByDateByTorn($torn, $date)
    {
        $availableTables = [];
    
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['data_reserva'] != $date) {
                $availableTables[] = $table['id']; 
            }
        }
    
        if (!empty($availableTables)) {
            $randomTableIndex = array_rand($availableTables);
            return $availableTables[$randomTableIndex];
        } else {
            return null;
        }
    }
    

    public function saveDataInTableInTorn($id, $torn, $date)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $key => &$table) {
            if ($table['id'] == $id) {
                if (!is_array($table['data_reserva'])) {
                    $table['data_reserva'] = [];
                }
                $table['data_reserva'][] = $date;
                return $table;
            }
        }
        return null;
    }
    public function saveNumPersInTableInTorn($id, $torn, $n_pers_reservation)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $key => &$table) {
            if ($table['id'] == $id) {
                if (!is_array($table['numero_persones'])) {
                    $table['numero_persones'] = [];
                }
                $table['numero_persones'][] = $n_pers_reservation;
                return $table;
            }
        }
        return null;
    }
    public function getFirstTableFreeByTorn($torn)
    {

        foreach ($_SESSION[$this->model . '_turn' . $torn] as $table) {
            if ($table['ocupat'] == false) {
                return $table;
            }
        }

        return null;
    }
    public function updateTable($id, $torn)
    { {
            $id = $_GET['id_table'] ?? null;
            foreach ($_SESSION[$this->model . '_turn' . $torn] as $key => $_SESSION['table']) {
                if ($_SESSION['table']['id'] == $id) {
                    $_SESSION[$this->model . '_turn' . $torn][$key]['ocupat'] = !$_SESSION[$this->model . '_turn' . $torn][$key]['ocupat'];
                    return $_SESSION[$this->model . '_turn' . $torn][$key];
                }
            }
            return null;
        }
    }
    public function updateAllTable($id, $torn, $date, $n_pers_reservation, $name_reservation, $id_reservation)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $key => &$table) {
            if ($table['id'] == $id) {
                $table['ocupat'] = !$table['ocupat'];
                $table['data_reserva'] = $date;
                $table['numero_persones'] = $n_pers_reservation;
                $table['name_reservation'] = $name_reservation;
                $table['id_reservation'] = $id_reservation ;
                return $table;
            }
        }
        return null;
    }
    public function putNameReservation($id, $name, $torn)
    {
        foreach ($_SESSION[$this->model . '_turn' . $torn] as $key => $_SESSION['table']) {
            if ($_SESSION['table']['id'] == $id) {
                $_SESSION[$this->model . '_turn' . $torn][$key]['name_reservation'] = $name;
                return $_SESSION[$this->model . '_turn' . $torn][$key];
            }
        }
        return null;
    }
    public function getReservationByIdTableTorn1($id)
    {
        foreach ($_SESSION[$this->model . '_turn1'] as $table) {
            if ($table['id'] == $id) {
                return $table['id_reservation'];
            }
        }
        return null;
    }
    public function getTablesByTorn1(){
        $taules = [];
        foreach ($_SESSION[$this->model . '_turn1'] as $table) {
            if ($table['torn'] == 1) {
                $taules[] = $table;
            }
        }
        return $taules;
    }
    
}
