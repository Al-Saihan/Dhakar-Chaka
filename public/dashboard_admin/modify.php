<?php
session_start();
$base = '/dhakar-chaka/public/';
include '../../includes/db_connect.php';


if ($_POST) {
    $serial_id = $_POST['serial_id'];
    $appointer_id = $_POST['appointer_id'];
    $mecha_id = $_POST['mecha_id'];
} else {
    header(header: "Location: " . $base . "dashboard_admin/process.php");
    exit;
}

$mechanics = [];
try {
    $stmt = $pdo->query("SELECT * FROM mechanic");
    $mechanics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle error appropriately
    error_log("Database error: " . $e->getMessage());
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Dhakar Chaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans text-gray-800 bg-gray-50">
    <?php include '../../includes/header.php'; ?>

    <main class="min-h-screen flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-extrabold text-blue-800">
                    Modify Appointment
                </h2>
                <p class="mt-2 text-lg text-gray-600">
                    Change Date or Mechanic for Appointment ID: <?= htmlspecialchars($serial_id) ?>
                </p>
            </div>


            <form class="space-y-6 bg-white p-10 rounded-xl shadow-2xl border border-gray-100"
                action="<?= $base ?>dashboard_admin/process.php" method="POST">
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Appointer ID</label>
                        <div
                            class="mt-2 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 sm:text-sm">
                            <?= htmlspecialchars($appointer_id) ?>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700">Current Mechanic ID</label>
                        <div
                            class="mt-2 px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-900 sm:text-sm">
                            <?= htmlspecialchars($mecha_id) ?>
                        </div>
                    </div>
                    <div>
                        <label for="appointment_date" class="block text-sm font-semibold text-gray-700">Appointment
                            Date</label>
                        <input id="appointment_date" name="appointment_date" type="date" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            min="<?= date('Y-m-d') ?>">
                    </div>

                    <div>
                        <label for="mechanic" class="block text-sm font-semibold text-gray-700">Select Mechanic</label>
                        <select id="mechanic" name="new_mechanic" required
                            class="mt-1 w-full px-3 py-2 border border-gray-300 rounded focus:border-blue-500 focus:outline-none">
                            <option value="" class="text-gray-500">Choose a mechanic</option>
                            <?php foreach ($mechanics as $mechanic): ?>
                                <option value="<?= htmlspecialchars($mechanic['mechanic_id']) ?>">
                                    <?= htmlspecialchars($mechanic['name']) ?> |
                                    <?= htmlspecialchars($mechanic['position']) ?> |
                                    Free Slots: <?= 4 - $mechanic['appointments'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="serial_id" value="<?= htmlspecialchars($serial_id) ?>">
                <input type="hidden" name="appointer_id" value="<?= htmlspecialchars($appointer_id) ?>">
                <input type="hidden" name="mecha_id" value="<?= htmlspecialchars($mecha_id) ?>">

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-lg font-bold rounded-lg text-white bg-blue-700 shadow-md hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                        Book Appointment
                    </button>
                </div>
            </form>
        </div>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>