<?php
session_start();
$base = '/dhakar-chaka/public/'; // my project root relative to localhost
include '../../includes/db_connect.php';
echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log In - Dhakar Chaka</title>
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <main>
        <div
            class="min-h-[calc(100vh-theme(spacing.16)-theme(spacing.16))] flex items-center justify-center bg-gray-100">

            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login to Your Account</h2>
                <form action="<?= $base ?>login/process.php" method="POST" class="space-y-6">
                    <div>
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <a href="<?= $base ?>/signup" class="text-blue-600 hover:underline text-sm">Don't have an
                            account?</a>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-700 text-white font-semibold py-2 rounded-lg hover:bg-blue-800 transition duration-300">Login</button>
                </form>
            </div>
        </div>
    </main>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>