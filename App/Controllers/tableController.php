<?php
class TableController extends Controller
{
    private $tableModel;



    public function getTableStatusById($id)
    {
        $tableModel = new Table();
        return $tableModel->getTableStatusById($id);
    }

    public function list()
    {
        $tableModel = new Table();

        $torn = $_POST['torn'] ?? 1;
        $params['llista'] = $tableModel->getAllTorn1();
        $params['title'] = "Llista de Taules - torn " . $torn;

        $this->render("table/list", $params, "site");
    }
    public function listTables()
    {
        $tableModel = new Table();
        $params['llista1'] = $tableModel->getAllTorn1();
        $params['llista2'] = $tableModel->getAllTorn2();

        $params['title'] = "Llista de Taules";
        $this->render("table/listTables", $params, "site");
    }
    public function listTables2()
    {
        $tableModel = new Table();
        $params['llista1'] = $tableModel->getAllTorn1();
        $params['llista2'] = $tableModel->getAllTorn2();

        $params['title'] = "Llista de Taules";
        $this->render("table/listTables2", $params, "site");
    }
    public function listTab2()
    {
        $tableModel = new Table();

        $torn = $_POST['torn'] ?? 2;
        $params['llista'] = $tableModel->getAllTorn2();
        $params['title'] = "Llista de Taules - torn " . $torn;

        $this->render("table/listTab2", $params, "site");
    }

    // public function listByDay($day = null)
    // {
    //     $tableModel = new Table();

    //     $day = $_GET['day'] ?? null;
    //     $params['title'] = "Llista de Reserves per Dia";
    //     $params['taules'] = $tableModel->getTablesByDay($day);
    //     $this->render("table/listByDay", $params, "site");
    // }
    public function changeStateTab1()
    {
        $tableModel = new Table();
        $id = $_GET['id_table'] ?? null;
        $torn = 1;
        $tableModel->updateTable($id, $torn);
        header("Location: /table/listTables");
    }
    public function changeStateTab2()
    {
        $tableModel = new Table();
        $id = $_GET['id_table'] ?? null;
        $torn = 2;
        $tableModel->updateTable($id, $torn);
        header("Location: /table/listTables2");
    }
    public function listByDayListTab1()
    {
        $reservationtModel = new Reservation();
        $day = $_GET['day'] ?? null;
        $params['title'] = "Llista de Taules per Dia";
        $params['llista'] = $reservationtModel->getReservationByDayTorn1($day, 1);
        $this->render("table/viewReservationByTableTorn1", $params, "site");
    }
    public function listByDayListTab2()
    {
        $reservationtModel = new Reservation();
        $day = $_GET['day'] ?? null;
        $params['title'] = "Llista de Taules per Dia";
        $params['llista'] = $reservationtModel->getReservationByDayTorn2($day, 2);
        $this->render("table/viewReservationByTableTorn2", $params, "site");
    }
    // public function listByDayTab1()
    // {
    //     $tableModel = new Table();
    //     $day = $_GET['day'] ?? null;
    //     $params['title'] = "Llista de Taules per Dia Torn 1";
    //     var_dump($day);
    //     $params['llista'] = $tableModel->getTablesByDay($day, 1);
    //     var_dump($params['llista']);
    //     $this->render("table/list", $params, "site");
    // }
    public function listByDayTab1()
    {
        $tableModel = new Table();
        $day = $_GET['day'] ?? null;
        $params['title'] = "Llista de Taules per Dia Torn 1";
        $params['llista'] = $tableModel->getTablesByDay($day, 1);
        $this->render("table/viewReservationByTableTorn1", $params, "site");
    }
    public function listByDayTab2()
    {
        $tableModel = new Table();
        $day = $_GET['day'] ?? null;
        $params['title'] = "Llista de Taules per Dia Torn 1";
        $params['llista'] = $tableModel->getTablesByDay($day, 2);
        $this->render("table/viewReservationByTableTorn2", $params, "site");
    }
    public function liberate()
    {
        $tableModel = new Table();
        $id = $_GET['id_table'] ?? null;
        $params['id'] = $id;
        $dates = $tableModel->getTableDates($id, 1);
        $params['dates'] = $dates;
        $this->render("table/confirmLiberate", $params, "site");
    }

    public function confirmLiberate()
    {
        $tableModel = new Table();
    
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id_table'] ?? null;
            $dates = $tableModel->getTableDates($id, 1);
            $params['id'] = $id;
            $params['dates'] = $dates;
    
            $this->render("table/confirmLiberate", $params, "site");
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_table'] ?? null;
            $dateToDelete = $_POST['date_to_delete'] ?? null; 
            $tableModel->liberateTable($id, 1, $dateToDelete);
            header("Location: /table/listTables");
        }
    }
    public function liberate2()
    {
        $tableModel = new Table();
        $id = $_GET['id_table'] ?? null;
        $tableModel->updateTable($id, 2);
        header("Location: /table/listTables2");
    }
    public function viewReservationByTorn1(){
        $reservationModel = new Reservation();
        $params['title'] = "Llista de Taules per Dia Torn 1";
        $params['llista'] = $reservationModel->getReservationByTorn1();
        $this->render("table/viewReservationByTableTorn1", $params, "site");
    }
    public function viewReservationByTorn2(){
        $reservationModel = new Reservation();
        $params['title'] = "Llista de Taules per Dia Torn 2";
        $params['llista'] = $reservationModel->getReservationByTorn2();
        $this->render("table/viewReservationByTableTorn2", $params, "site");
    }
}
