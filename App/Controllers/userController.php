<?php
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/User.php");
include_once(__DIR__ . "/../Models/Reservation.php");
include_once(__DIR__ . "../../Core/Store.php");
include_once(__DIR__ . "/../Core/Mailer.php");

class userController extends Controller
{

    public function home()
    {

        $params['title'] = 'Benvingut/da!';
        $this->render("user/home", $params, "site");
    }

    public function index()
    {
        if (isset($_SESSION['logged_user'])) {
            header("Location: /user/list");
        }

        if (!isset($params['flash_ok'])) {
            $params['flash_ok'] = null;
            $_SESSION['flash_ok'] = null;
        }
        $params['flash_ok'] = $_SESSION['flash_ok'];
        unset($_SESSION['flash_ok']);
        $params['title'] = 'Iniciar Sessió';

        $this->render("user/login", $params, "site");
    }

    public function list()
    {
        $userModel = new User();
        $llista = $userModel->getAll();

        $_SESSION['llista'] = $llista;
        $params['title'] = "Llista d'usuaris";
        $params['llista'] = $llista;

        if (empty($llista)) {
            $_SESSION['missatge_flash'] = "No hi ha usuaris";
        }
        if (isset($_SESSION['missatge_flash'])) {
            $params['missatge_flash'] = $_SESSION['missatge_flash'];
        }
        $params['title'] = 'Llistat d\'usuaris';
        $reservations = new Reservation();
        $params['reservations'] = $reservations->getAll();
        $this->render("user/list", $params, "main");
    }
    public function store()
    {

        $userModel = new User();
        $username = $_POST['username'];
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        $avisLegalDades = $_POST['avisLegalDades'] ?? null;
        $avisEnviamentPropaganda = $_POST['avisEnviamentPropaganda'] ?? null;

        $avisEnviamentPropaganda = isset($_POST['avisEnviamentPropaganda']) ? true : false;

        $validationResult = $userModel->validateUser($username, $name, $mail, $pass, $avisLegalDades, $avisEnviamentPropaganda);

        if ($validationResult !== null) {
            $_SESSION['missatge_flash'] = $validationResult;
            header("Location: /user/create");
            return;
        }
        if (isset($_POST['admin'])) {
            $admin = true;
        } else {
            $admin = ($username === 'admin') ? true : false;
        }



        $origen = $_FILES['profile_image']['tmp_name'];
        $desti = "images/profile_images/";
        $array = explode(".", $_FILES['profile_image']['name']);
        $extensio = $array[count($array) - 1];
        $nomFitxer = $username . "." . $extensio;

        // Genera un token aleatori
        $caracters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $token = substr(str_shuffle($caracters), 0, 15);

        // Verificar si hi ha error al pujar l'arxiu
        if ($_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['missatge_flash'] = "Error al pujar l'imatge. Recorda :Nomès s'accepten imatges en format jpg.";
            header("Location: /user/create");
            return;
        }

        // Intentar moure l'arxiu a la carpeta de destí
        $storeResult = Store::store($origen, $desti, $nomFitxer);

        // Verificar si hi ha error al moure arxiu
        if ($storeResult !== true) {
            $_SESSION['missatge_flash'] = "Error al pujar l'imatge. Recorda :Nomès s'accepten imatges en format jpg.";
            header("Location: /user/create");
            return;
        }

        $user = array(
            "username" => $username,
            "name" => $name,
            "mail" => $mail,
            "pass" => $pass,
            "admin" => $admin,
            "avisLegalDades" => $avisLegalDades,
            "avisEnviamentPropaganda" => $avisEnviamentPropaganda,
            "profile_image" => $nomFitxer,
            "token" => $token,
            "verified" => false
        );

        $mail = new Mailer();
        $mail->isSMTP();
        $mail->mailServerSetup();
        $mail->addRec([$user['mail']], [], []);
        $mail->addVeifyContent($user);
        $mail->send();

        if (!isset($_SESSION['logged_user'])) {
            $_SESSION['logged_user'] = $user;
        }

        $userModel->create($user);

        $_SESSION['missatge_flash'] = "Usuari creat correctament";

        header("Location: /user/index");
    }


    public function storeEditUser()
    {

        $userModel = new User();
        $username = $_POST['username'];
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        $avisLegalDades = !isset($_POST['avisLegalDades']) === true;
        $avisEnviamentPropaganda = isset($_POST['avisEnviamentPropaganda']) ? true : false;

        $currentUsername = $_SESSION['logged_user']['username'];

        $admin = ($username === 'admin') ? true : false;

        if (empty($username) || empty($name) || empty($mail) || empty($pass)) {
            $_SESSION['missatge_flash'] = "Has d'omplir tots els camps";

            header("Location: /user/edit/?id_user=$currentUsername");
            return;
        }
        if ($_SESSION['logged_user']['admin'] === false) {

            if ($_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $origen = $_FILES['profile_image']['tmp_name'];
                $desti = "images/profile_images/";
                $array = explode(".", $_FILES['profile_image']['name']);
                $extensio = $array[count($array) - 1];
                $nomFitxer = $username . "." . $extensio;

                $storeResult = Store::store($origen, $desti, $nomFitxer);

                if ($storeResult !== true) {
                    $_SESSION['missatge_flash'] = "Error al moure la imatge. Recorda ha de ser format .jpg";
                    header("Location: /user/edit/?id_user=$currentUsername");
                    return;
                }
                $verified = $_POST['verified'] ?? true;
                $updatedUser = array(
                    "username" => $username,
                    "name" => $name,
                    "mail" => $mail,
                    "pass" => $pass,
                    "admin" => $admin,
                    "avisLegalDades" => $avisLegalDades,
                    "avisEnviamentPropaganda" => $avisEnviamentPropaganda,
                    "verified" => $verified
                );

                $userModel->updateUserAdmin($updatedUser);

                $_SESSION['missatge_flash'] = "Usuari editat correctament";


                header("Location: /user/index");
            } else {
                $verified = $_SESSION['logged_user']['verified'] ?? false;

                $updatedUser = array(
                    "username" => $username,
                    "name" => $name,
                    "mail" => $mail,
                    "pass" => $pass,
                    "admin" => $admin,
                    "avisLegalDades" => $avisLegalDades,
                    "avisEnviamentPropaganda" => $avisEnviamentPropaganda,
                    "verified" => $verified
                );

                $_SESSION['logged_user'] = $updatedUser;

                $userModel->update($currentUsername, $updatedUser);

                $_SESSION['missatge_flash'] = "Usuari editat correctament";
            }
        }
    }



    public function create()
    {

        $params['title'] = 'Crear usuari';
        $this->render("user/create", $params, "site");
        //include_once(__DIR__ . "../../Views/user/create.view.php");
    }


    public function login()
    {
        $username = $_POST['username'] ?? null;
        $pass = $_POST['pass'] ?? null;

        $userModel = new User();
        $result = $userModel->login($username, $pass);

        if ($result !== null) {
            $_SESSION['logged_user'] = $result;

            if ($result['username'] == 'admin') {
                $params['llista'] = $userModel->getAll();
                header("Location: /user/list");
            }

            $params['usuari'] = $result;
            header("Location: /user/list");
        } else {
            $_SESSION['missatge_flash'] = "Credencials incorrectes";
            $params['title'] = 'Iniciar Sessió';
            $this->render("user/login", $params, "site");
        }
    }

    public function edit()
    {
        $userModel = new User();
        if (isset($_GET['id_user'])) {
            $username = $_GET['id_user'];
        }
        $user = $userModel->getByUsername($username);
        $params['title'] = "Editar usuari";
        $params['user'] = $user;
        $this->render("user/edit", $params, "main");
    }
    public function logout()
    {
        unset($_SESSION['logged_user']);
        header("Location: /user/index");
    }

    public function admin()
    {
        $params['title'] = 'Administrador';
        $this->render("user/admin", $params, "site");
    }

    public function delete()
    {
        $userModel = new User();
        if (isset($_GET['id_user'])) {
            $username = $_GET['id_user'];
        }
        $userModel->removeUserByUsername($username);
        header("Location: /user/list");
    }
    public function chat()
    {
        $params['title'] = 'Chat';

        $params['messages'] = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
        $params['username_client'] = $_SESSION['logged_user']['username'] ?? null;
        $this->render("user/chat", $params, "site");
    }

    public function chatAdmin()
    {
        $id_user = $_GET['id_user'];
        $params['title'] = 'Chat Admin';

        $params['messages'] = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];

        $params['username'] = $id_user;
        $_SESSION['username_chat'] = $id_user;

        $this->render("user/chat_admin", $params, "site");
    }


    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $_POST['message'];
            $username = $_SESSION['logged_user']['username'];
            $this->sendEmailNotification($message, $username, 'client');


            $_SESSION['messages'][$username][] = array('type' => 'client', 'content' => $message);

            header("Location: /user/chat");
            exit();
        }
    }
    public function chat_admin()
    {
        $params['title'] = 'Chat Admin';
        $params['messages'] = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
        $params['username'] = $_SESSION['username_chat'];
        $this->render("user/chat_admin", $params, "site");
    }
    public function sendMessageAdmin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $_POST['message'];
            $username = $_SESSION['username_chat'];

            $_SESSION['messages'][$username][] = array('type' => 'admin', 'content' => $message);

            $this->sendEmailNotification($message, $username, 'admin');
            $params['username'] = $username;
            header("Location: /user/chat_admin");
            exit();
        }
    }
    private function sendEmailNotification($message, $username, $recipientType)
    {
        $userModel = new User();

        $user = $userModel->getByUsername($username);
        $email = $user['mail'];

        $mail = new Mailer();
        $mail->isSMTP();
        $mail->mailServerSetup();

        $recipients = ($recipientType === 'admin') ? [$email] : ['marcramilogarrido04@gmail.com'];
        $mail->addRec($recipients, [], []);

        $subject = ($recipientType === 'admin') ? 'Nou missatje al chat' : "Nou missatje de l'usuari: " . $username;
        $content = "Tens un nou missatje al chat: $message" . "Usari: $username";

        $mail->addContentChat($content);

        $mail->send();
    }
    public function verify()
    {
        if (isset($_GET['username'], $_GET['token'])) {
            $username = $_GET['username'];
            $token = $_GET['token'];

            $userModel = new User();
            $user = $userModel->getByUsername($username);

            if ($user && isset($user['token']) && $user['token'] === $token) {
                if ($user['verified']) {
                    $_SESSION['missatge_flash'] = "L'usuari ja ha estat verificat anteriorment.";
                } else {
                    $user['verified'] = true;
                    $userModel->updateUser($user);

                    if (isset($_SESSION['logged_user']) && $_SESSION['logged_user']['username'] === $username) {
                        $_SESSION['logged_user']['verified'] = true;
                    }

                    $_SESSION['missatge_flash'] = "Usuari verificat correctament.";
                }
            } else {
                $_SESSION['missatge_flash'] = "Error en verificar l'usuari. El token no coincideix.";
            }
        } else {
            $_SESSION['missatge_flash'] = "Falta el nom d'usuari o el token a la URL.";
        }

        header("Location: /user/index");
    }
}
