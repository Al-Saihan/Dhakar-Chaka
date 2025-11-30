<?php
session_start();
$base = '/dhakar-chaka/public/';
include '../../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $area = trim($_POST['area']);
    $street = trim($_POST['street']);
    $postal_code = trim($_POST['postal_code']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // ! Combine address into single variable
    $address = $street . ', ' . $area . ', ' . $city . ', ' . $postal_code;

    // ! Validate name
    if (empty($name)) {
        $_SESSION['signup_error'] = "Name is required.";
        header("Location: " . $base . "signup/");
        exit;
    } else if (preg_match('/\d/', $name)) {
        $_SESSION['signup_error'] = "Name cannot contain numbers.";
        header("Location: " . $base . "signup/");
        exit;
    }

    // ! Validate phone number - must be exactly 11 digits
    if (strlen($phone) != 11 || !ctype_digit($phone)) {
        $_SESSION['signup_error'] = "Phone number must be exactly 11 numerical digits.";
        header("Location: " . $base . "signup/");
        exit;
    }

    // ! Validate required address fields
    if (empty($city) || empty($area) || empty($street)) {
        $_SESSION['signup_error'] = "City, area, and street address are required.";
        header("Location: " . $base . "signup/");
        exit;
    }

    // ! Validate password - must have more than 5 characters
    if (strlen($password) <= 5) {
        $_SESSION['signup_error'] = "Password must have more than 5 characters.";
        header("Location: " . $base . "signup/");
        exit;
    }

    // ! Confirm passwords match
    if ($password !== $confirm_password) {
        $_SESSION['signup_error'] = "Passwords do not match.";
        header("Location: " . $base . "signup/");
        exit;
    }

    // ! Check if phone number already exists
    $sql = "SELECT phone FROM user WHERE phone = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$phone]);
    if ($stmt->fetch()) {
        $_SESSION['signup_error'] = "Phone number already registered.";
        header("Location: " . $base . "signup/");
        exit;
    }

    // ! Insert new user
    $sql = "INSERT INTO user (name, phone, address, password) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$name, $phone, $address, $password])) {
        $_SESSION['signup_success'] = "Account created successfully! Please log in.";
        header("Location: " . $base . "login/");
        exit;
    } else {
        $_SESSION['signup_error'] = "Registration failed. Please try again.";
        header("Location: " . $base . "signup/");
        exit;
    }
} else {
    // If not a POST request, redirect to signup page
    header("Location: " . $base . "signup/");
    exit;
}