<?php
session_start();
$base = '/dhakar-chaka/public/';
include '../../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mecha_id = $_POST['mecha_id'];
    $new_mechanic = $_POST['new_mechanic'];
    $appointer_id = $_POST['appointer_id'];
    $serial_id = $_POST['serial_id'];
    $appoint_date = $_POST['appointment_date'];


    try {
        // ! CHECKING if client already has an appointment on the selected date
        $stmt = $pdo->prepare(query: "SELECT COUNT(*) FROM appointments WHERE appointer_id = ? AND appoint_date = ? AND resolved = 0");
        $stmt->execute([$appointer_id, $appoint_date]);
        $existing_appointment = $stmt->fetchColumn();

        if ($existing_appointment > 0) {
            $_SESSION['error'] = "User already has an appointment scheduled on " . $appoint_date;
            header("Location: {$base}dashboard_admin/modify.php");
            exit();
        }

        // ! Check if mechanic has reached maximum appointments for the day
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE mecha_id = ? AND resolved = 0");
        $stmt->execute([$mecha_id]);
        $mechanic_appointments = $stmt->fetchColumn();

        $max_appointments_per_day = 4;

        if ($mechanic_appointments >= $max_appointments_per_day) {
            $_SESSION['error'] = "Sorry the mechanic is currently not available, please try someone else.";
            header("Location: {$base}dashboard_admin/modify.php");
            exit();
        }

        // ? Update the appointment
        $stmt = $pdo->prepare("UPDATE appointments SET appoint_date = ?, mecha_id = ? WHERE serial_id = ?");
        $result = $stmt->execute([$appoint_date, $new_mechanic, $serial_id]);

        // ? Update mechanic's appointment count
        $stmt = $pdo->prepare("UPDATE mechanic SET appointments = appointments - 1 WHERE mechanic_id = ?");
        $stmt->execute([$mecha_id]);
        $stmt = $pdo->prepare("UPDATE mechanic SET appointments = appointments + 1 WHERE mechanic_id = ?");
        $stmt->execute([$new_mechanic]);

        if ($result) {
            $_SESSION['success'] = "Appointment updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update appointment. Please try again.";
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    header("Location: {$base}dashboard_admin/modify.php");
    exit();
}
else{
    header("Location: " . $base . "dashboard_admin/");
    exit;
}
?>