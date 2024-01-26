<?php

class mainController extends Controller{

    public function index(){
        $params = null;
        $this->render("home/index", $params, "site");
    }

}

?>