@resource('layouts/master')
<section class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden md:flex w-[810px] h-[554px]  md:items-center">
        <div class="md:w-1/2 px-6 py-8 md:border-r">
            <h2 class="text-2xl font-bold mb-6 text-center"><?= env('APP_NAME') ?></h2>
            <p class="text-gray-600 mb-6 text-center">Sign in to your account</p>
            <?php if (isset($errors['email'])) : ?>
                <?= showError('email', $errors); ?>
            <?php endif; ?>

            <?php if (isset($errors['password'])) : ?>
                <?= showError('password', $errors); ?>
            <?php endif; ?>
            <form action="/auth/login" method="POST">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input input-primary type="email" id="email" name="email" class="input input-primary" required value="<?= old('email') ?>" />
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input input-primary type="password" id="password" name="password" class="input input-primary" required />
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-left mb-4">
                        <input input-primary type="checkbox" name="remember" id="remember" />
                        <label for="remember" class="text-sm text-gray-700"> Remember Me</label>
                    </div>

                    <div class="text-right mb-4">
                        <a href="/auth/forgot-password" class="text-sm text-primary-500 hover:underline hover:font-bold transition-all">Forgot password?</a>
                    </div>
                </div>
                <div class="mb-6">
                    <button type="submit" class="w-full text-white py-2 rounded-md btn btn-primary">
                        Sign in
                    </button>
                </div>
                <p class="text-sm text-gray-600">Don't have an account?
                    <a href="/auth/register" class="text-primary-500 hover:underline hover:font-bold transition-all">Register</a>
                </p>
            </form>

        </div>
        <div class="md:w-1/2 hidden md:block">
            <img src="<?= asset('/image/login.jpg') ?>" alt="Login" class="w-full h-[550px] object-cover">
        </div>
    </div>
</section>
