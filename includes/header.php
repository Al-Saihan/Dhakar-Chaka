<header class="shadow-lg sticky top-0 z-10">
    <nav class="bg-blue-900 px-6 sm:px-10 py-4 flex justify-between items-center relative">

        <a href="<?= $base ?>"
            class="text-white text-3xl font-bold tracking-tight hover:text-blue-200 transition duration-300">
            Dhakar Chaka
        </a>

        <div class="hidden md:flex items-center space-x-6">
            <ul class="flex space-x-4">
                <li>
                    <a href="<?= $base ?>"
                        class="text-white font-semibold uppercase tracking-wider px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Home</a>
                </li>
                <li>
                    <a href="<?= $base ?>#services"
                        class="text-white font-semibold uppercase tracking-wider px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Services</a>
                </li>
                <li>
                    <a href="<?= $base ?>#why-choose-us"
                        class="text-white font-semibold uppercase tracking-wider px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">About
                        Us</a>
                </li>
            </ul>

            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if (isset($_SESSION['is_moderator']) && $_SESSION['is_moderator']): ?>
                    <a href="<?= $base ?>dashboard_admin/"
                        class="text-white font-semibold uppercase tracking-wider px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Dashboard</a>
                <?php else: ?>
                    <a href="<?= $base ?>dashboard_user/"
                        class="text-white font-semibold uppercase tracking-wider px-3 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Dashboard</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="<?= $base ?>login/"
                    class="bg-white text-blue-700 font-bold uppercase text-sm px-4 py-2 rounded-full hover:bg-gray-100 transition duration-300">
                    Sign-In
                </a>
            <?php endif; ?>
        </div>

        <div class="md:hidden">
            <button id="mobile-menu-button" onclick="toggleMobileNav()" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <div id="mobileNav"
            class="hidden md:hidden absolute top-full left-0 w-full bg-blue-900 border-t border-blue-700 shadow-xl z-20">
            <div class="px-6 py-4 space-y-3">
                <a href="<?= $base ?>"
                    class="block text-white font-semibold uppercase tracking-wider py-2 hover:text-blue-200 transition duration-150">Home</a>
                <a href="<?= $base ?>#services"
                    class="block text-white font-semibold uppercase tracking-wider py-2 hover:text-blue-200 transition duration-150">Services</a>
                <a href="<?= $base ?>#why-choose-us"
                    class="block text-white font-semibold uppercase tracking-wider py-2 hover:text-blue-200 transition duration-150">About
                    Us</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (isset($_SESSION['is_moderator']) && $_SESSION['is_moderator']): ?>
                        <a href="<?= $base ?>dashboard_admin.php"
                            class="block text-white font-semibold uppercase tracking-wider py-2 hover:text-blue-200 transition duration-150">Dashboard</a>
                    <?php else: ?>
                        <a href="<?= $base ?>dashboard_user.php"
                            class="block text-white font-semibold uppercase tracking-wider py-2 hover:text-blue-200 transition duration-150">Dashboard</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?= $base ?>login/"
                        class="block bg-white text-blue-700 font-bold uppercase text-sm px-4 py-2 rounded-full hover:bg-gray-100 text-center mt-4 shadow transition duration-150">Sign-In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<script>
    function toggleMobileNav() {
        const nav = document.getElementById('mobileNav');
        nav.classList.toggle('hidden');
    }
</script>