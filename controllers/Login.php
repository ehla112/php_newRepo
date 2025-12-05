<?php
require_once "models/User.php"; //NOSONAR: MVC sin namespaces, necesario cargar modelo

class Login {

    // Constantes
    private const VIEW_LOGIN         = 'views/company/login.view.php';
    private const LOCATION_DASHBOARD = 'Location:?c=Dashboard';

    // Controlador Principal
    public function main() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (empty($_SESSION['session'])) {
                $message = "";
                require_once self::VIEW_LOGIN; //NOSONAR: inclusión de vista
            } else {
                header(self::LOCATION_DASHBOARD);
                exit;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $profile = new User(
                $_POST['user_email'],
                $_POST['user_pass']
            );
            $profile = $profile->login();

            if ($profile) {
                $active = $profile->getUserState();
                if ($active != 0) {
                    $_SESSION['session'] = $profile->getRolName();
                    $_SESSION['profile'] = serialize($profile);
                    header(self::LOCATION_DASHBOARD);
                    exit;
                } else {
                    $message = "El Usuario NO está activo";
                    require_once self::VIEW_LOGIN; //NOSONAR: inclusión de vista
                }
            } else {
                $message = "Credenciales incorrectas ó el Usuario NO existe";
                require_once self::VIEW_LOGIN; //NOSONAR: inclusión de vista
            }
        }
    }
}
?>
