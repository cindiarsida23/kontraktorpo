<?php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'title' => 'Dashboard',
            'message' => 'Selamat datang di aplikasi kontraktor.',
        ]);
    }
}
