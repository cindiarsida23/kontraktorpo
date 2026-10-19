<?php

require_once __DIR__ . '/../core/Controller.php';

class AdminLoginController extends Controller
{
    public function index(): void
    {
        if (isLoggedIn()) {
            redirect('/admin');
        }

        $this->view('auth/login', [
            'title' => 'Login Admin',
            'error' => flash('error'),
        ]);
    }
}
