<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también se puede borrar la cookie de sesión.
// Nota: ¡Esto destruirá la sesión y no solo los datos de la sesión!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destruir la sesión
session_destroy();

// Redirigir al inicio de sesión u a otra página de tu elección
header('Location: ../index.php');
exit;
?>
