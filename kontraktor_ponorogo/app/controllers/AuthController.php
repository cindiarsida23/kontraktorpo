<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController extends Controller
{
    public function loginPage(): void
    {
        if (isLoggedIn()) {
            redirect('/admin');
        }

        $this->view('auth/login', [
            'title' => 'Login Admin',
            'error' => flash('error'),
        ]);
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->loginPage();
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            flash('error', 'Email dan password wajib diisi.');
            redirect('/admin/login');
        }

        $userModel = new UserModel();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            flash('error', 'Email atau password salah.');
            redirect('/admin/login');
        }

        if (($user['status'] ?? 'active') !== 'active') {
            flash('error', 'Akun Anda tidak aktif.');
            redirect('/admin/login');
        }

        session_regenerate_id(true);

        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        redirect('/admin');
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        redirect('/admin/login');
    }
}
