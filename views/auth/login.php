<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <main class="container mx-auto p-4 mt-8 flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-xl shadow-lg p-10 w-full max-w-md">
            <h1 class="text-3xl font-extrabold text-[#e5383b] mb-6 text-center">Login Admin</h1>
            <p class="text-gray-600 text-center mb-8">Silakan masuk untuk mengakses panel administrasi.</p>

            <?php if (!empty($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>

            <form action="/pondok-subusalam/login" method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center items-center space-x-2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#e5383b] hover:bg-[#ba181b] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ba181b]">
                        <i class="fas fa-lock"></i>
                        <span>Masuk</span>
                    </button>
                </div>
            </form>
            
            <div class="mt-4 text-center">
                <a href="/pondok-subusalam/home" class="text-sm text-gray-600 hover:text-[#ba181b] inline-flex items-center space-x-1">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </main>
</body>
</html>
