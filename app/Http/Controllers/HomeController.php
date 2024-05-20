<?php

namespace App\Http\Controllers;

use App\Core\Authenticator;
use App\Core\Mail;
use App\Core\Request;
use App\Core\Response;
use App\Core\Router;
use App\Core\Session;
use App\Models\Model;
use App\Models\User;
use PHPMailer\PHPMailer\Exception;
use PhpParser\Node\Expr\AssignOp\Mod;
use Random\RandomException;

class HomeController extends Controller
{
    public function index(): void
    {
        Response::view('index', [
        ]);
    }

    public function render_login(): void
    {
        Response::view('auth/login', [
            'heading' => 'Sign in to your account',
            'errors' => Session::get('errors')
        ]);
    }

    public function render_register(): void
    {
        Response::view('auth/register', [
            'heading' => 'Create new Account',
            'errors' => Session::get('errors')
        ]);
    }

    public function render_forgot_password(): void
    {
        Response::view('auth/forgot_password', [
            'heading' => 'Forgot Password'
        ]);
    }


    /**
     * @throws RandomException
     */
    public function login(Request $request): void
    {
        $request
            ->validate([
                'email' => 'required|email',
                'password' => "required|string|password|passwordVerify:{$request->input('email')}",
            ]);


        Authenticator::attempt(
            $request->input('email'),
            $request->input('password')
        );

        Response::redirect('/');
    }

    public function register(Request $request): void
    {
        $request->validate([
            'username' => 'required|string|min:2|max:16|unique:users,username',
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|password',
            'phone_number' => 'required|string|min:10|max:20|unique:users,phone_number|regex:/^([0-9\s\-\+\(\)]*)$/',
            'other_name' => 'string|min:2|max:255',
        ]);

        $user = Authenticator::register((array)$request->all());

        if ($user) {
            redirect('/');
        }
    }

    public function logout(): void
    {
        Authenticator::logout();
        redirect('/auth/login');
    }

    public function aboutUs(Request $request): void
    {
        Response::view('about-us', [

        ]);
    }

    /**
     * @throws RandomException
     * @throws Exception
     */
    public function sendResetLink(Request $request): bool
    {
        $mail = new Mail();

        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::find('email', $request->input('email'), ['id', 'email', 'first_name']);


        $token = bin2hex(random_bytes(16));

        $passwordToken = Model::raw('SELECT COUNT(*) AS count FROM password_resets WHERE user_id = ?', [$user->id]);

        if ($passwordToken[0]->count === 0) {
            Model::raw("INSERT INTO password_resets (user_id, token) VALUES (?, ?)", [$user->id, $token]);
        } else {
            Model::raw('UPDATE password_resets SET token = ? WHERE user_id = ?', [$token, $user->id]);
        }


        $resetLink = "http://127.0.0.1:8000/auth/reset-password/$token";

        $subject = "Password Reset for Your Account";
        $body = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Reset Your Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 16px;
      line-height: 1.5;
      margin: 0;
      padding: 0;
    }
    .container {
      padding: 20px;
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .content {
      background-color: #f0f0f0;
      padding: 20px;
    }
    .link {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="logo"><?= env('APP_NAME') ?></h1>
    <div class="content">
      <h1>Hi! $user->first_name,</h1>
      <p>We received a request to reset your password. If you didn't initiate this request, you can safely ignore this email.</p>
      <p>Click on the link to reset your password:</p>
      <a class="link" href="$resetLink">Click here</a>
      <p>If the button is not working copy this to url into a new tab: $resetLink</p>
      <p>This link will expire in 24 hours for security reasons. If you don't reset your password within 24 hours, you'll need to request a new password reset.</p>
      <p>Thanks,</p>
      <p>Your <?= env('APP_NAME') ?></p>
    </div>
  </div>
</body>
</html>
HTML;

        $mail->send($user->email, $subject, $body);

        Session::flash('success', "A password reset link has been sent to your email address.");
        Response::redirect(Router::previousUrl());
        return true;
    }


    public function resetPassword(Request $request): void
    {
        $token = $request->params()->token;

        $query = "SELECT user_id, created_at FROM password_resets WHERE token = ? AND created_at > DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
        $result = Model::raw($query, [$token]);
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        if ($password !== $password_confirmation) {
            Session::flash('error', 'Password mismatch');
        }
        $user = Authenticator::passwordReset($password, $result[0]->user_id);
        if ($user) {
            Model::raw('DELETE FROM password_resets WHERE token = ?', [$token]);
        }

        Response::redirect('/auth/login');
    }

    public function renderResetPassword(Request $request): void
    {
        $token = $request->params()->token;

        $user = Model::raw('SELECT user_id from password_resets WHERE token = ?', [$token]);

        if (!$user) {
            Response::redirect('/auth/forgot-password');
        }

        Response::view('/auth/reset-password', [
            'token' => $token,
        ]);
    }


    public function dashboard(Request $request): void
    {
        Response::view('dashboard/index');
    }
}
