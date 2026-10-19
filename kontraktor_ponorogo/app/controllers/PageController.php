<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/HouseModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';
require_once __DIR__ . '/../models/ContactModel.php';
require_once __DIR__ . '/../models/ServiceModel.php';
require_once __DIR__ . '/../models/TestimonialModel.php';
require_once __DIR__ . '/../models/CompanyStructureModel.php';

class PageController extends Controller
{
    public function home(): void
    {
        $houseModel = new HouseModel();
        $projectModel = new ProjectModel();
        $serviceModel = new ServiceModel();
        $testimonialModel = new TestimonialModel();

        $this->view('site/home', [
            'title' => 'PT Graha Lestari - Developer Properti & Kontraktor Terpercaya Ponorogo',
            'houses' => $houseModel->all('id DESC'),
            'projects' => $projectModel->all('id DESC', 6),
            'services' => $serviceModel->all('sort_order ASC'),
            'testimonials' => $testimonialModel->getActiveTestimonials(),
        ]);
    }

    public function about(): void
    {
        $this->view('site/about', [
            'title' => 'Tentang Kami - PT Graha Lestari',
        ]);
    }

    public function structure(): void
    {
        $structureModel = new CompanyStructureModel();
        $members = $structureModel->getAllAsMap();

        $this->view('site/structure', [
            'title' => 'Struktur Perusahaan - PT Graha Lestari',
            'members' => $members,
        ]);
    }

    public function services(): void
    {
        $serviceModel = new ServiceModel();

        $this->view('site/services', [
            'title' => 'Layanan',
            'services' => $serviceModel->all('sort_order ASC'),
        ]);
    }

    public function portfolio(): void
    {
        $projectModel = new ProjectModel();
        $houseModel = new HouseModel();

        $this->view('site/portfolio', [
            'title' => 'Portofolio Proyek - PT Graha Lestari',
            'projects' => $projectModel->all('id DESC'),
            'houses' => $houseModel->all('id DESC'),
        ]);
    }

    public function contact(): void
    {
        $this->view('site/contact', [
            'title' => 'Kontak',
            'success' => flash('success'),
            'error' => flash('error'),
        ]);
    }

    public function storeContact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/contact');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name === '' || $email === '' || $message === '') {
            flash('error', 'Nama, email, dan pesan wajib diisi.');
            redirect('/contact');
        }

        $contactModel = new ContactModel();
        $contactModel->create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'subject' => $subject,
            'message' => $message,
            'status' => 'new',
        ]);

        // Construct Admin WhatsApp forwarding URL
        $adminWaNumber = siteSetting('whatsapp_number', '6281359099658');
        $adminWaNumber = preg_replace('/[^0-9]/', '', $adminWaNumber);
        if (str_starts_with($adminWaNumber, '0')) {
            $adminWaNumber = '62' . substr($adminWaNumber, 1);
        }

        $waText = "Halo PT Graha Lestari, saya ingin berkonsultasi mengenai proyek properti:\n\n" .
            "📌 *Nama:* " . $name . "\n" .
            "✉️ *Email:* " . $email . "\n" .
            "📱 *No. Telp/WA:* " . ($phone ?: '-') . "\n" .
            "🏷️ *Subjek:* " . ($subject ?: 'Konsultasi Properti') . "\n\n" .
            "💬 *Detail Pesan/Rencana Bangunan:*\n" . $message;

        $_SESSION['wa_forward_url'] = "https://wa.me/" . $adminWaNumber . "?text=" . rawurlencode($waText);

        flash('success', 'Pesan konsultasi Anda telah berhasil tersimpan di database sistem dan sedang diteruskan ke WhatsApp Admin.');
        redirect('/contact');
    }
}
