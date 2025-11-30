<?php
session_start();
$base = '/dhakar-chaka/public/';
include '../../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $phone = trim($_POST['phone']);

    // ! Validate phone number - must be exactly 11 digits
    if (strlen($phone) != 11 || !ctype_digit($phone)) {
        $_SESSION['login_error'] = "Phone number must be exactly 11 digits.";
        header("Location: " . $base . "login/");
        exit;
    }

    $password = trim($_POST['password']);

    // ! Validate password - must have more than 5 characters
    if (strlen(string: $password) <= 5) {
        $_SESSION['login_error'] = "Password must have more than 5 characters.";
        header("Location: " . $base . "login/");
        exit;
    }

    // ! Running Query
    $sql = "SELECT user_id, password, moderator FROM user WHERE phone = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$phone]);
    $user = $stmt->fetch();

    // ! Verify password and set session + redirect
    if ($user && $password == $user['password']) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['is_moderator'] = (bool) $user['moderator'];

        if ($_SESSION['is_moderator']) {
            header("Location: " . $base . "dashboard_admin");
        } else {
            if (isset($_SESSION['redirect_after_login'])) {
                $redirect_url = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']);
                header("Location: " . $redirect_url);
            } else {
                header("Location: " . $base . "dashboard_user");
            }
        }
        exit;

    } else {
        $_SESSION['login_error'] = "Invalid phone number or password.";
        echo "<script>console.log('CODE 03: Invalid login attempt for phone: " . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . "');</script>";
        header("Location: " . $base . "login/");
        exit;
    }
} else {
    header("Location: " . $base . "login/");
    exit;
}
?>