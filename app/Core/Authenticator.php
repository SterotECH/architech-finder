<?php

namespace App\Core;

use App\Enums\UserRole;
use App\Models\User;
use Exception;
use Random\RandomException;

class Authenticator
{
    private static array $config;

    private static function loadConfig(): void
    {
        if (!isset(self::$config)) {
            self::$config = require base_path('config/auth.php');
        }
    }

    public static function attempt(string $email, string $password, bool $remember = false): bool
    {
        self::loadConfig();

        $user = User::where(self::$config['database']['username'], $email)
            ->first([
                'id', 'first_name', 'last_name', 'role', 'is_active',
                'email', 'phone_number', 'avatar', 'password', 'is_superuser'
            ]);

        if ($user && password_verify($password, $user->{self::$config['database']['password']}) && $user->is_active) {
            self::login($user, $remember);
            return true;
        }

        return false;
    }

    public static function login($user, bool $remember = false): void
    {
        self::loadConfig();

        $_SESSION[self::$config['session']['name']] = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone_number' => $user->phone_number,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'role' => $user->role,
            'is_superuser' => $user->is_superuser,
        ];

        session_regenerate_id(true);

        if ($remember) {
            $token = bin2hex(random_bytes(32));

            $newUser = new User();
            $newUser->id = $user->id;
            $newUser->remember_token = $token;
            $newUser->save();

            setcookie(
                'remember_token',
                $token,
                time() + (30 * 24 * 60 * 60), // 30 days
                self::$config['session']['path'],
                self::$config['session']['domain'],
                self::$config['session']['secure'],
                self::$config['session']['httponly']
            );
        }
    }

    public static function logout(): void
    {
        Session::destroy();
    }

    public static function user(): ?object
    {
        self::loadConfig();

        return isset($_SESSION[self::$config['session']['name']])
            ? (object)$_SESSION[self::$config['session']['name']]
            : null;
    }

    public static function check(): bool
    {
        self::loadConfig();

        return isset($_SESSION[self::$config['session']['name']]);
    }

    public static function register(array $data): object|bool
    {
        self::loadConfig();

        $user = new User();
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->phone_number = $data['phone_number'];
        $user->email = $data['email'];
        $user->location = $data['location'];
        $user->gender = $data['gender'] ?? 'Male';
        $user->avatar = $data['avatar'] ?? null;
        $user->is_superuser = 0;
        $user->is_active = 1;
        $user->role = UserRole::from($data['role'])->value;
        $user->password = password_hash($data['password'], self::$config['hash']['algorithm'], self::$config['hash']['options']);

        return $user->save();
    }

    public static function passwordReset(string $password, string|int $user_id): bool
    {
        self::loadConfig();

        $user = User::find('id',$user_id);
        if (!$user) {
            throw new Exception("User not found.");
        }

        $user->password = password_hash($password, self::$config['hash']['algorithm'], self::$config['hash']['options']);

        return $user->save();
    }

    public static function checkRememberMe(): void
    {
        self::loadConfig();

        if (self::user() === null && isset($_COOKIE['remember_token'])) {
            $rememberToken = $_COOKIE['remember_token'];

            $user = User::where('remember_token', $rememberToken)->first();

            // dd($user);

            if (!$user) {
                self::login($user, true);
            }
        }
    }
}
