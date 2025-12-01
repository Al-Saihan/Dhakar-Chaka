<?php
session_start();
$base = '/dhakar-chaka/public/'; // my project root relative to localhost
include '../../includes/db_connect.php';

$stmt = $pdo->query("SELECT * FROM user WHERE user_id = $_SESSION[user_id]");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT a.*, m.name as mechanic_name, m.position as mechanic_rank, u.name as user_name, u.phone as user_phone, u.address as user_address
                    FROM appointments a 
                    LEFT JOIN mechanic m ON a.mecha_id = m.mechanic_id 
                    LEFT JOIN user u ON a.appointer_id = u.user_id
                    ORDER BY a.appoint_date DESC");

$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Name
Address
Phone
Car Registration No.
Appointment Date
Mechanic Name -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dhakar Chaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans text-gray-800">
    <?php include '../../includes/header.php'; ?>
    <main>
        <div class="container mx-auto px-4 py-8">
            <!-- User Profile Section -->
            <div class="bg-white border border-gray-100 rounded-lg shadow-md p-6 mb-8 text-center">
                <h1 class="text-3xl font-bold mb-6">Admin Profile</h1>
                <?php if (!empty($users)): ?>
                    <?php $user = $users[0]; ?>
                    <div class="grid md:grid-cols-1 gap-6">
                        <div>
                            <h2 class="text-xl font-semibold mb-4">Personal Information</h2>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium">Admin ID:</span>
                                    <span class="ml-2"><?php echo htmlspecialchars($user['user_id'] ?? 'N/A'); ?></span>
                                </div>
                                <div>
                                    <span class="font-medium">Name:</span>
                                    <span class="ml-2"><?php echo htmlspecialchars($user['name'] ?? 'N/A'); ?></span>
                                </div>
                                <div>
                                    <span class="font-medium">Phone:</span>
                                    <span class="ml-2"><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></span>
                                </div>
                                <div>
                                    <span class="font-medium">Address:</span>
                                    <span class="ml-2"><?php echo htmlspecialchars($user['address'] ?? 'N/A'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-red-500">User information not found.</p>
                <?php endif; ?>
            </div>

            <!-- Appointments Section -->
            <div class="bg-white border border-gray-100 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">All Appointments</h2>

                <!-- Result -->
                <div class = "mb-6 text-center">
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

                <?php if (!empty($appointments)): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-3 text-center">User Name</th>
                                    <th class="border p-3 text-center">Address</th>
                                    <th class="border p-3 text-center">Phone</th>
                                    <th class="border p-3 text-center">Car Registration No.</th>
                                    <th class="border p-3 text-center">Appointment Date</th>
                                    <th class="border p-3 text-center">Mechanic Name</th>
                                    <th class="border p-3 text-center">Modify Appointment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border p-3 text-center">
                                            <?php echo htmlspecialchars($appointment['user_name'] ?? 'N/A'); ?>
                                        </td>
                                        <td class="border p-3 text-center">
                                            <?php echo htmlspecialchars($appointment['user_address'] ?? 'N/A'); ?>
                                        </td>
                                        <td class="border p-3 text-center">
                                            <?php echo htmlspecialchars($appointment['user_phone'] ?? 'N/A'); ?>
                                        </td>
                                        <td class="border p-3 text-center">
                                            <?php echo htmlspecialchars($appointment['car_reg_no'] ?? 'N/A'); ?>
                                        </td>
                                        <td class="border p-3 text-center">
                                            <?php echo htmlspecialchars($appointment['appoint_date'] ?? 'N/A'); ?>
                                        </td>
                                        <td class="border p-3 text-center">
                                            <?php if (!empty($appointment['mechanic_name'])): ?>
                                                <?php echo htmlspecialchars($appointment['mechanic_name']); ?>
                                                <br>
                                                <small
                                                    class="text-gray-600"><?php echo htmlspecialchars($appointment['mechanic_rank'] ?? 'N/A'); ?></small>
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td class="border p-3 text-center">
                                            <form action="modify.php" method="POST" style="display: inline;">
                                                <input type="hidden" name="serial_id"
                                                    value="<?php echo htmlspecialchars($appointment['serial_id'] ?? 0); ?>">
                                                <input type="hidden" name="appointer_id"
                                                    value="<?php echo htmlspecialchars($appointment['appointer_id'] ?? 0); ?>">
                                                <input type="hidden" name="mecha_id"
                                                    value="<?php echo htmlspecialchars($appointment['mecha_id'] ?? 0); ?>">
                                                <button type="submit"
                                                    class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                                    Edit Date / Change Mechanic
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">No appointments found.</p>
                        <a href="<?php echo $base; ?>appointments/create.php"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Schedule New Appointment
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>