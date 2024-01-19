<?php require base_path("views/partials/head.php") ?>

<main class="w-full h-screen flex">
    <div class="m-auto w-[50%] lg:w-[25%] max-md:w-full max-md:p-10">
        <h1 class="text-gray-700 text-center font-black text-2xl mb-4">E-Clearance Login</h1>
        <form action="/store" method="POST" class="bg-white shadow-md border rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="email" placeholder="Email" name="email" value="<?php if (isset($temp)) : ?> <?= $temp ?> <?php endif; ?>" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" name="password" required>
            </div>
            <div class="flex flex-col items-center justify-between">
                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
                <a class="mt-4 inline-block align-baseline font-bold text-xs text-indigo-500 hover:text-indigo-800 " href="https://www.facebook.com/cjcACSS" target="_blank">
                    Request here if you dont have an account
                </a>
            </div>
        </form>
        <?php if (isset($error)) : ?>
            <p class="text-center text-red-600 mb-6 font-bold "><?= $error ?></p>
            <?php unset($_SESSION["_flushed"]["login"]);  ?>
        <?php endif; ?>

        <p class="text-center text-gray-500 text-xs ">
            &copy;2023 ACSS. All rights reserved.
        </p>
    </div>
</main>

<?php require base_path("views/partials/footer.php") ?>