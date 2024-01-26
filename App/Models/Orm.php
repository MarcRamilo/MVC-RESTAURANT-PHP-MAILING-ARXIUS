<?php

class Orm{

    protected $model;

    public function __construct($model){

        $this->model = $model;
        if(!isset($_SESSION[$model])){
            $_SESSION[$model] = [];
        }

    }

    public function getById($id){
        foreach ($_SESSION[$this->model] as $item) {
            if($item['id'] == $id){
                return $item;
            }
        }
    }

    public function create($item){
        $_SESSION[$this->model][] = $item;
    }

    public function getAll(){

        return $_SESSION[$this->model];
    }

    
    public function reset(){
        unset($_SESSION[$this->model]);
    }
    
    public function removeItemById($id){
        foreach ($_SESSION[$this->model] as $key => $item) {
            if($item['id'] == $id){
                unset($_SESSION[$this->model][$key]);
                return $item;
            }
        }
        return null;
    }
      
    public function updateItemById($itemUpdated){
        foreach ($_SESSION[$this->model] as $key => $item) {
            if($item['id'] == $itemUpdated['id']){
                $_SESSION[$this->model][$key] = $itemUpdated;
                return $itemUpdated;
            }
        }
        return null;
    }
    public function udapteUser($data){
        foreach ($_SESSION[$this->model] as $key => $user) {
            if($user['username'] == $data['username']){
                $_SESSION[$this->model][$key] = $data;
                return $data;
            }
        }
    }

}


?>