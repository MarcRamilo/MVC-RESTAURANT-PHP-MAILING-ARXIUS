<?php

include_once("Orm.php");

class User extends Orm
{

    public function __construct()
    {
        parent::__construct('users');
        if (!isset($_SESSION['id_user'])) {
            $_SESSION['id_user'] = "";
        }
    }


    public function login($u, $p)
    {
        foreach ($_SESSION[$this->model] as $user) {
            if ($user['username'] == $u && $user['pass'] == $p) {
                return $user;
            }
        }
        return null;
    }
    public function getByUsername($username)
    {
        foreach ($_SESSION[$this->model] as $user) {
            if ($user['username'] == $username) {
                return $user;
            }
        }
        return null;
    }

    public function removeUserByUsername($username)
    {
        foreach ($_SESSION[$this->model] as $key => $user) {
            if ($user['username'] == $username) {
                unset($_SESSION[$this->model][$key]);
                return $user;
            }
        }
        return null;
    }
    public function getByMail($mail)
    {
        foreach ($_SESSION[$this->model] as $user) {
            if ($user['mail'] == $mail) {
                return $user;
            }
        }
        return null;
    }

    public function validateUser($username, $name, $mail, $pass, $avisLegalDades, $avisEnviamentPropaganda)
    {
        if (!isset($avisLegalDades)) {
            return "Has d'acceptar l'avis legal de dades";
        } else {
            $avisLegalDades = true;
        }
        if (!isset($avisEnviamentPropaganda)) {
            $avisEnviamentPropaganda = false;
        } else {
            $avisEnviamentPropaganda = true;
        }
        $existingUser = $this->getByUsername($username);
        if ($existingUser !== null) {
            return "L'usuari ja existeix";
        }
        $existingMail = $this->getByMail($mail);
        if ($existingMail !== null) {
            return "El correu ja existeix";
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return "El correu no és vàlid";
        }
        if (strlen($pass) < 8 || !preg_match("#[0-9]+#", $pass) || !preg_match("#[A-Z]+#", $pass) || !preg_match("#[a-z]+#", $pass)) {
            return "La contrasenya no compleix els requisits mínims";
        }
        return null;
    }
    public function update($username, $data)
    {
        $users = $_SESSION[$this->model];
    
        foreach ($users as $key => $user) {
            if ($user['username'] == $username) {
                foreach ($data as $field => $value) {
                    $users[$key][$field] = $value;
                }
                break;
            }
        }
    
        $_SESSION[$this->model] = $users;
    }
    public function updateUserAdmin($updatedUser)
    {
        foreach ($_SESSION[$this->model] as $key => $user) {
            if ($user['username'] === $updatedUser['username']) {
                $_SESSION[$this->model][$key] = $updatedUser; 
                return $_SESSION[$this->model][$key];
            }
        }
        return null; 
    }
    public function updateUser($updatedUser)
    {
        foreach ($_SESSION[$this->model] as $key => $user) {
            if ($user['username'] === $updatedUser['username']) {
                $_SESSION[$this->model][$key]['verified'] = $updatedUser['verified']; 
                return $_SESSION[$this->model][$key];
            }
        }
        return null; 
    }
}
