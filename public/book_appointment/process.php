<?php
session_start();
$base = '/dhakar-chaka/public/';
include '../../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointer_id = $_SESSION['user_id'];
    $mecha_id = $_POST['mechanic'];
    $appoint_date = $_POST['appointment_date'];
    $car_reg_no = $_POST['car_license'];
    $car_eng_no = $_POST['car_engine'];

    try {
        // ! CHECKING if client already has an appointment on the selected date
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE appointer_id = ? AND appoint_date = ? AND resolved = 0");
        $stmt->execute([$appointer_id, $appoint_date]);
        $existing_appointment = $stmt->fetchColumn();

        if ($existing_appointment > 0) {
            $_SESSION['error'] = "You already have an appointment scheduled on " . $appoint_date;
            header("Location: {$base}/book_appointment/");
            exit();
        }

        // ! Check if mechanic has reached maximum appointments for the day
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE mecha_id = ? AND resolved = 0");
        $stmt->execute([$mecha_id]);
        $mechanic_appointments = $stmt->fetchColumn();

        $max_appointments_per_day = 4; 

        if ($mechanic_appointments >= $max_appointments_per_day) {
            $_SESSION['error'] = "Sorry the mechanic is currently not available, please try someone else.";
            header("Location: {$base}/book_appointment/");
            exit();
        }

        // ? Create the appointment
        $stmt = $pdo->prepare("INSERT INTO appointments (appointer_id, mecha_id, appoint_date, car_reg_no, car_eng_no, resolved) VALUES (?, ?, ?, ?, ?, 0)");
        $result = $stmt->execute([$appointer_id, $mecha_id, $appoint_date, $car_reg_no, $car_eng_no]);

        // ? Update mechanic's appointment count
        $stmt = $pdo->prepare("UPDATE mechanic SET appointments = appointments + 1 WHERE mechanic_id = ?");
        $stmt->execute([$mecha_id]);
        
        if ($result) {
            $_SESSION['success'] = "Appointment booked successfully!";
        } else {
            $_SESSION['error'] = "Failed to book appointment. Please try again.";
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    header("Location: {$base}/book_appointment/");
    exit();
}
?>