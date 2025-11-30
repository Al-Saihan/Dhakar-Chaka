<?php
session_start();
$base = '/dhakar-chaka/public/';  // my project root relative to localhost
include '../../includes/db_connect.php';

// Fetch user details if logged in
$user_name = '';
$user_address = '';
$user_phone = '';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT name, address, phone FROM user WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $user_name = $user['name'];
        $user_address = $user['address'];
        $user_phone = $user['phone'];
    }
} else {
    // Redirect to login if not logged in
    $_SESSION['redirect_after_login'] = $base . 'book_appointment/';
    header('Location: ' . $base . 'login');
    exit();
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
                    Book Appointment
                </h2>
                <p class="mt-2 text-lg text-gray-600">
                    Schedule your car service with Dhakar Chaka.
                </p>
            </div>
            <div>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <?= htmlspecialchars($_SESSION['error']) ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        <?= htmlspecialchars($_SESSION['success']) ?>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
            </div>

            <form class="space-y-6 bg-white p-10 rounded-xl shadow-2xl border border-gray-100"
                action="<?= $base ?>book_appointment/process.php" method="POST">
                <div class="space-y-5">

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <input id="name" name="name" type="text" required readonly
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-100 cursor-not-allowed focus:outline-none sm:text-sm transition duration-150"
                            placeholder="Enter your full name" value="<?= htmlspecialchars($user_name ?? '') ?>">
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                        <textarea id="address" name="address" required rows="3" readonly
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-100 cursor-not-allowed focus:outline-none sm:text-sm transition duration-150"
                            placeholder="Enter your complete address"><?= htmlspecialchars($user_address ?? '') ?></textarea>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                        <input id="phone" name="phone" type="tel" required readonly
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-100 cursor-not-allowed focus:outline-none sm:text-sm transition duration-150"
                            placeholder="e.g., +880 1XXXXXXXXX" value="<?= htmlspecialchars($user_phone ?? '') ?>">
                    </div>

                    <div>
                        <label for="car_license" class="block text-sm font-semibold text-gray-700">Car License
                            No.</label>
                        <input id="car_license" name="car_license" type="text" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Enter car license number">
                    </div>

                    <div>
                        <label for="car_engine" class="block text-sm font-semibold text-gray-700">Car Engine No.</label>
                        <input id="car_engine" name="car_engine" type="text" required
                            class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:border-blue-500 sm:text-sm transition duration-150"
                            placeholder="Enter car engine number">
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
                        <select id="mechanic" name="mechanic" required
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