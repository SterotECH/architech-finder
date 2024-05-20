@resource('layouts/master')
<section class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden sm:w-[500px]">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Forgot Password</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Enter your email address to reset your password.
            </p>
        </div>
        <div class="border-t border-gray-200">
            <?php use App\Core\Session;

            if (Session::get('success') !== null): ?>
                <p class="px-4 py-1 text-center bg-green-100 text-green-500 rounded-md mt-4"><?= Session::get('success') ?></p>
            <?php elseif(Session::get('error') !== null): ?>
                <p class="px-4 py-1 text-center bg-red-100 text-red-500 rounded-md mt-4"><?= Session::get('error') ?></p>
            <?php endif; ?>
            <form action="/auth/forgot-password" method="POST" class="px-4 py-5 sm:p-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 gap-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="<?= old('email') ?>" required />
                    </div>
                    <?php if (isset($errors['email'])) : ?>
                        <?php displayError($errors['email']); ?>
                    <?php endif; ?>
                </div>
                <div class="mt-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">
                        Reset Password
                    </button>
                </div>
                <p class="text-sm text-gray-600 mt-4">Remember Password? <a href="/auth/login" class="text-indigo-600">signin</a></p>
            </form>
        </div>
    </div>
</section>

</body>

</html>
