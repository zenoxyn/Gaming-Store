<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "head.html"; ?>
    <title>Gaming Store - Login</title>
</head>

<body class="bg-[#3a0ca3] min-h-screen flex items-center justify-center">

    <!-- Card Login -->
    <div class=" w-[850px] rounded-xl flex overflow-hidden shadow-lg">

        <!-- Kiri (Poster / Gambar) -->
        <div class="w-1/2 bg-cover bg-center" style="background-image: url('../image/cat-1.png');">
        </div>

        <!-- Kanan (Form Login) -->
        <div class="w-1/2 p-10 text-white bg-[#3a0ca3]">
            <div class="flex justify-between items-center mb-6 text-center">
                <h2 class="text-3xl font-bold">Welcome to FryN Store</h2>
                <a href="index.php"><i class="ri-close-line text-2xl hover:text-red-400"></i></a>
            </div>

            <label class="text-sm">Username</label>
            <input type="text" class="w-full mt-1 mb-4 p-3 rounded-lg bg-[#4b1fc6] placeholder-gray-300">

            <label class="text-sm">Password</label>
            <input type="password" class="w-full mt-1 p-3 rounded-lg bg-[#4b1fc6] placeholder-gray-300">

            <button class="w-full mt-6 p-3 rounded-lg bg-linear-to-r from-purple-500 to-pink-500 font-semibold">
                Sign In
            </button>

            <div class="flex items-center gap-4 my-6">
                <div class="grow border-t border-white/40"></div>
            </div>

            <p class="mt-6 text-sm text-center">Belum punya akun? <a href="regrister.php" class="underline">Daftar Disini</a></p>
        </div>
    </div>

</body>


</html>