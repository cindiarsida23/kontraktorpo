<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/HouseModel.php';
require_once __DIR__ . '/../models/ServiceModel.php';
require_once __DIR__ . '/../models/ProjectModel.php';
require_once __DIR__ . '/../models/ContactModel.php';
require_once __DIR__ . '/../models/SiteSettingModel.php';
require_once __DIR__ . '/../models/CompanyStructureModel.php';
require_once __DIR__ . '/../models/TestimonialModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class AdminController extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('/admin/login');
        }
    }

    public function index(): void
    {
        $houseModel = new HouseModel();
        $projectModel = new ProjectModel();
        $contactModel = new ContactModel();

        $cNew = (int)($contactModel->query("SELECT COUNT(*) as total FROM contacts WHERE status = 'new'")[0]['total'] ?? 0);
        $cRead = (int)($contactModel->query("SELECT COUNT(*) as total FROM contacts WHERE status = 'read'")[0]['total'] ?? 0);
        $cReplied = (int)($contactModel->query("SELECT COUNT(*) as total FROM contacts WHERE status = 'replied'")[0]['total'] ?? 0);
        $hAvail = (int)($houseModel->query("SELECT COUNT(*) as total FROM houses WHERE status = 'available'")[0]['total'] ?? 0);
        $pOngoing = (int)($projectModel->query("SELECT COUNT(*) as total FROM projects WHERE status = 'ongoing'")[0]['total'] ?? 0);

        $this->view('admin/dashboard', [
            'title' => 'Dashboard Admin',
            'houseCount' => (int)($houseModel->query('SELECT COUNT(*) as total FROM houses')[0]['total'] ?? 0),
            'projectCount' => (int)($projectModel->query('SELECT COUNT(*) as total FROM projects')[0]['total'] ?? 0),
            'contactCount' => (int)($contactModel->query('SELECT COUNT(*) as total FROM contacts')[0]['total'] ?? 0),
            'contactNew' => $cNew,
            'contactRead' => $cRead,
            'contactReplied' => $cReplied,
            'houseAvailable' => $hAvail,
            'projectOngoing' => $pOngoing,
            'latestContacts' => $contactModel->all('id DESC', 5),
            'user' => currentUser(),
        ]);
    }

    public function housesIndex(): void
    {
        $houseModel = new HouseModel();
        $this->view('admin/houses/index', [
            'title' => 'Katalog Rumah',
            'houses' => $houseModel->all('id DESC'),
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function housesCreate(): void
    {
        $this->view('admin/houses/form', [
            'title' => 'Tambah Rumah',
            'house' => [],
            'mode' => 'create',
            'user' => currentUser(),
        ]);
    }

    public function housesStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/houses');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'area_size' => trim($_POST['area_size'] ?? ''),
            'bedrooms' => (int)($_POST['bedrooms'] ?? 0),
            'bathrooms' => (int)($_POST['bathrooms'] ?? 0),
            'type' => trim($_POST['type'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => trim($_POST['status'] ?? 'available'),
        ];

        if ($data['title'] === '' || $data['price'] === '') {
            flash('error', 'Judul dan harga rumah wajib diisi.');
            redirect('/admin/houses/create');
        }

        if ($data['slug'] === '') {
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        }

        $uploadedFile = saveUploadedFile($_FILES['cover_image'] ?? [], 'houses');
        if ($uploadedFile) {
            $data['cover_image'] = $uploadedFile;
        }

        $houseModel = new HouseModel();
        $houseModel->create($data);

        flash('success', 'Katalog rumah berhasil ditambahkan.');
        redirect('/admin/houses');
    }

    public function housesEdit(int $id): void
    {
        $houseModel = new HouseModel();
        $house = $houseModel->find($id);

        if (!$house) {
            flash('error', 'Data rumah tidak ditemukan.');
            redirect('/admin/houses');
        }

        $this->view('admin/houses/form', [
            'title' => 'Edit Rumah',
            'house' => $house,
            'mode' => 'edit',
            'user' => currentUser(),
        ]);
    }

    public function housesUpdate(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/houses');
        }

        $houseModel = new HouseModel();
        $existing = $houseModel->find($id);

        if (!$existing) {
            flash('error', 'Data rumah tidak ditemukan.');
            redirect('/admin/houses');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'price' => trim($_POST['price'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'area_size' => trim($_POST['area_size'] ?? ''),
            'bedrooms' => (int)($_POST['bedrooms'] ?? 0),
            'bathrooms' => (int)($_POST['bathrooms'] ?? 0),
            'type' => trim($_POST['type'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'status' => trim($_POST['status'] ?? 'available'),
        ];

        if ($data['slug'] === '') {
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        }

        $uploadedFile = saveUploadedFile($_FILES['cover_image'] ?? [], 'houses');
        if ($uploadedFile) {
            $data['cover_image'] = $uploadedFile;
        }

        $houseModel->update($id, $data);

        flash('success', 'Katalog rumah berhasil diperbarui.');
        redirect('/admin/houses');
    }

    public function housesDelete(int $id): void
    {
        $houseModel = new HouseModel();
        $houseModel->delete($id);
        flash('success', 'Katalog rumah berhasil dihapus.');
        redirect('/admin/houses');
    }

    public function servicesIndex(): void
    {
        $serviceModel = new ServiceModel();
        $this->view('admin/services/index', [
            'title' => 'Kelola Layanan',
            'services' => $serviceModel->all('sort_order ASC'),
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function servicesCreate(): void
    {
        $this->view('admin/services/form', [
            'title' => 'Tambah Layanan',
            'service' => [],
            'mode' => 'create',
            'user' => currentUser(),
        ]);
    }

    public function servicesStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/services');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'icon' => trim($_POST['icon'] ?? 'home'),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ];

        if ($data['title'] === '') {
            flash('error', 'Judul layanan wajib diisi.');
            redirect('/admin/services/create');
        }

        if ($data['slug'] === '') {
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        }

        $serviceModel = new ServiceModel();
        $serviceModel->create($data);

        flash('success', 'Layanan berhasil ditambahkan.');
        redirect('/admin/services');
    }

    public function servicesEdit(int $id): void
    {
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($id);

        if (!$service) {
            flash('error', 'Data layanan tidak ditemukan.');
            redirect('/admin/services');
        }

        $this->view('admin/services/form', [
            'title' => 'Edit Layanan',
            'service' => $service,
            'mode' => 'edit',
            'user' => currentUser(),
        ]);
    }

    public function servicesUpdate(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/services');
        }

        $serviceModel = new ServiceModel();
        $existing = $serviceModel->find($id);

        if (!$existing) {
            flash('error', 'Data layanan tidak ditemukan.');
            redirect('/admin/services');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'icon' => trim($_POST['icon'] ?? 'home'),
            'sort_order' => (int)($_POST['sort_order'] ?? 0),
        ];

        if ($data['title'] === '') {
            flash('error', 'Judul layanan wajib diisi.');
            redirect('/admin/services/edit/' . $id);
        }

        if ($data['slug'] === '') {
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        }

        $serviceModel->update($id, $data);

        flash('success', 'Layanan berhasil diperbarui.');
        redirect('/admin/services');
    }

    public function servicesDelete(int $id): void
    {
        $serviceModel = new ServiceModel();
        $serviceModel->delete($id);
        flash('success', 'Layanan berhasil dihapus.');
        redirect('/admin/services');
    }

    public function projectsIndex(): void
    {
        $projectModel = new ProjectModel();
        $this->view('admin/projects/index', [
            'title' => 'Portofolio Proyek',
            'projects' => $projectModel->all('id DESC'),
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function projectsCreate(): void
    {
        $this->view('admin/projects/form', [
            'title' => 'Tambah Proyek',
            'project' => [],
            'mode' => 'create',
            'user' => currentUser(),
        ]);
    }

    public function projectsStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/projects');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'budget' => trim($_POST['budget'] ?? ''),
            'status' => trim($_POST['status'] ?? 'planning'),
            'description' => trim($_POST['description'] ?? ''),
        ];

        if ($data['title'] === '') {
            flash('error', 'Judul proyek wajib diisi.');
            redirect('/admin/projects/create');
        }

        if ($data['slug'] === '') {
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        }

        $uploadedFile = saveUploadedFile($_FILES['cover_image'] ?? [], 'projects');
        if ($uploadedFile) {
            $data['cover_image'] = $uploadedFile;
        }

        $projectModel = new ProjectModel();
        $projectModel->create($data);

        flash('success', 'Proyek berhasil ditambahkan.');
        redirect('/admin/projects');
    }

    public function projectsEdit(int $id): void
    {
        $projectModel = new ProjectModel();
        $project = $projectModel->find($id);

        if (!$project) {
            flash('error', 'Data proyek tidak ditemukan.');
            redirect('/admin/projects');
        }

        $this->view('admin/projects/form', [
            'title' => 'Edit Proyek',
            'project' => $project,
            'mode' => 'edit',
            'user' => currentUser(),
        ]);
    }

    public function projectsUpdate(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/projects');
        }

        $projectModel = new ProjectModel();
        $existing = $projectModel->find($id);

        if (!$existing) {
            flash('error', 'Data proyek tidak ditemukan.');
            redirect('/admin/projects');
        }

        $data = [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'location' => trim($_POST['location'] ?? ''),
            'category' => trim($_POST['category'] ?? ''),
            'budget' => trim($_POST['budget'] ?? ''),
            'status' => trim($_POST['status'] ?? 'planning'),
            'description' => trim($_POST['description'] ?? ''),
        ];

        if ($data['slug'] === '') {
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
        }

        $uploadedFile = saveUploadedFile($_FILES['cover_image'] ?? [], 'projects');
        if ($uploadedFile) {
            $data['cover_image'] = $uploadedFile;
        }

        $projectModel->update($id, $data);

        flash('success', 'Proyek berhasil diperbarui.');
        redirect('/admin/projects');
    }

    public function projectsDelete(int $id): void
    {
        $projectModel = new ProjectModel();
        $projectModel->delete($id);
        flash('success', 'Proyek berhasil dihapus.');
        redirect('/admin/projects');
    }

    public function settingsIndex(): void
    {
        $settingModel = new SiteSettingModel();
        $settings = $settingModel->getAllAsMap();

        $this->view('admin/settings/index', [
            'title' => 'Pengaturan Website',
            'settings' => $settings,
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function settingsStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/settings');
        }

        $fields = [
            'footer_about_text',
            'tiktok_username',
            'tiktok_url',
            'instagram_username',
            'instagram_url',
            'youtube_username',
            'youtube_url',
            'company_address',
            'contact_email',
            'operating_hours_weekday',
            'operating_hours_weekend',
            'whatsapp_number',
            'google_maps_iframe',
        ];

        $settingModel = new SiteSettingModel();

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                $val = trim($_POST[$field]);
                if ($field === 'google_maps_iframe') {
                    $val = sanitizeGoogleMapsUrl($val);
                }
                $settingModel->set($field, $val);
            }
        }

        flash('success', 'Pengaturan website & footer berhasil diperbarui.');
        redirect('/admin/settings');
    }

    public function structureIndex(): void
    {
        $structureModel = new CompanyStructureModel();
        $members = $structureModel->getAllAsMap();

        $this->view('admin/structure/index', [
            'title' => 'Struktur Perusahaan',
            'members' => $members,
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function structureStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/structure');
        }

        $positionKeys = [
            'komisaris_1',
            'komisaris_2',
            'direktur',
            'gm',
            'pengawas',
            'arsitek',
            'keuangan',
            'gudang',
        ];

        $structureModel = new CompanyStructureModel();

        foreach ($positionKeys as $key) {
            $name = trim($_POST['name_' . $key] ?? '');
            $roleTitle = trim($_POST['role_' . $key] ?? '');

            $uploadedPhoto = null;
            if (isset($_FILES['photo_' . $key])) {
                $fileResult = saveUploadedFile($_FILES['photo_' . $key], 'structure');
                if ($fileResult) {
                    $uploadedPhoto = $fileResult;
                }
            }

            if ($name !== '') {
                $structureModel->updateMember($key, $name, $roleTitle, $uploadedPhoto);
            }
        }

        flash('success', 'Struktur organisasi perusahaan berhasil diperbarui.');
        redirect('/admin/structure');
    }

    public function contactsIndex(): void
    {
        $contactModel = new ContactModel();
        $contacts = $contactModel->all('id DESC');

        $this->view('admin/contacts/index', [
            'title' => 'Pesan Konsultasi',
            'contacts' => $contacts,
            'unreadCount' => $contactModel->getUnreadCount(),
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function contactsStatus(int $id): void
    {
        $contactModel = new ContactModel();
        $contact = $contactModel->find($id);

        if ($contact) {
            $newStatus = trim($_POST['status'] ?? 'read');
            $contactModel->update($id, ['status' => $newStatus]);
            flash('success', 'Status pesan berhasil diperbarui.');
        }

        redirect('/admin/contacts');
    }

    public function contactsDelete(int $id): void
    {
        $contactModel = new ContactModel();
        $contactModel->delete($id);
        flash('success', 'Pesan konsultasi berhasil dihapus.');
        redirect('/admin/contacts');
    }

    public function testimonialsIndex(): void
    {
        $testimonialModel = new TestimonialModel();
        $testimonials = $testimonialModel->all('id DESC');

        $this->view('admin/testimonials/index', [
            'title' => 'Testimoni Klien',
            'testimonials' => $testimonials,
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function testimonialsCreate(): void
    {
        $this->view('admin/testimonials/form', [
            'title' => 'Tambah Testimoni Klien',
            'testimonial' => [],
            'mode' => 'create',
            'user' => currentUser(),
        ]);
    }

    public function testimonialsStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/testimonials');
        }

        $data = [
            'client_name' => trim($_POST['client_name'] ?? ''),
            'company_name' => trim($_POST['company_name'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'rating' => (int)($_POST['rating'] ?? 5),
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];

        if ($data['client_name'] === '' || $data['message'] === '') {
            flash('error', 'Nama klien dan ulasan testimoni wajib diisi.');
            redirect('/admin/testimonials/create');
        }

        $testimonialModel = new TestimonialModel();
        $testimonialModel->create($data);

        flash('success', 'Testimoni klien berhasil ditambahkan.');
        redirect('/admin/testimonials');
    }

    public function testimonialsEdit(int $id): void
    {
        $testimonialModel = new TestimonialModel();
        $testimonial = $testimonialModel->find($id);

        if (!$testimonial) {
            flash('error', 'Data testimoni tidak ditemukan.');
            redirect('/admin/testimonials');
        }

        $this->view('admin/testimonials/form', [
            'title' => 'Edit Testimoni Klien',
            'testimonial' => $testimonial,
            'mode' => 'edit',
            'user' => currentUser(),
        ]);
    }

    public function testimonialsUpdate(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/testimonials');
        }

        $testimonialModel = new TestimonialModel();
        $existing = $testimonialModel->find($id);

        if (!$existing) {
            flash('error', 'Data testimoni tidak ditemukan.');
            redirect('/admin/testimonials');
        }

        $data = [
            'client_name' => trim($_POST['client_name'] ?? ''),
            'company_name' => trim($_POST['company_name'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'rating' => (int)($_POST['rating'] ?? 5),
            'is_active' => isset($_POST['is_active']) ? 1 : 0,
        ];

        if ($data['client_name'] === '' || $data['message'] === '') {
            flash('error', 'Nama klien dan ulasan testimoni wajib diisi.');
            redirect('/admin/testimonials/edit/' . $id);
        }

        $testimonialModel->update($id, $data);

        flash('success', 'Testimoni klien berhasil diperbarui.');
        redirect('/admin/testimonials');
    }

    public function testimonialsToggle(int $id): void
    {
        $testimonialModel = new TestimonialModel();
        $existing = $testimonialModel->find($id);

        if ($existing) {
            $newStatus = ((int)$existing['is_active'] === 1) ? 0 : 1;
            $testimonialModel->update($id, ['is_active' => $newStatus]);
            flash('success', 'Status penampilan testimoni berhasil diubah.');
        }

        redirect('/admin/testimonials');
    }

    public function testimonialsDelete(int $id): void
    {
        $testimonialModel = new TestimonialModel();
        $testimonialModel->delete($id);
        flash('success', 'Testimoni klien berhasil dihapus.');
        redirect('/admin/testimonials');
    }

    public function usersIndex(): void
    {
        $userModel = new UserModel();
        $this->view('admin/users/index', [
            'title' => 'Manajemen Pengguna',
            'users' => $userModel->getAllUsers(),
            'success' => flash('success'),
            'error' => flash('error'),
            'user' => currentUser(),
        ]);
    }

    public function usersCreate(): void
    {
        $this->view('admin/users/form', [
            'title' => 'Tambah Pengguna',
            'userData' => [],
            'mode' => 'create',
            'user' => currentUser(),
        ]);
    }

    public function usersStore(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/users');
        }

        $userModel = new UserModel();
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role = trim($_POST['role'] ?? 'admin');
        $status = trim($_POST['status'] ?? 'active');

        if (empty($name) || empty($email) || empty($password)) {
            flash('error', 'Nama lengkap, username/email, dan password wajib diisi.');
            redirect('/admin/users/create');
        }

        if ($userModel->findByEmail($email)) {
            flash('error', 'Email / Username sudah terdaftar.');
            redirect('/admin/users/create');
        }

        $userModel->createUser([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'status' => $status
        ]);

        flash('success', 'Pengguna baru berhasil ditambahkan.');
        redirect('/admin/users');
    }

    public function usersEdit(int $id): void
    {
        $userModel = new UserModel();
        $userData = $userModel->getUserById($id);

        if (!$userData) {
            flash('error', 'Pengguna tidak ditemukan.');
            redirect('/admin/users');
        }

        $this->view('admin/users/form', [
            'title' => 'Edit Pengguna',
            'userData' => $userData,
            'mode' => 'edit',
            'user' => currentUser(),
        ]);
    }

    public function usersUpdate(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('/admin/users');
        }

        $userModel = new UserModel();
        $existing = $userModel->getUserById($id);

        if (!$existing) {
            flash('error', 'Pengguna tidak ditemukan.');
            redirect('/admin/users');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role = trim($_POST['role'] ?? 'admin');
        $status = trim($_POST['status'] ?? 'active');

        if (empty($name) || empty($email)) {
            flash('error', 'Nama lengkap dan username/email wajib diisi.');
            redirect('/admin/users/edit/' . $id);
        }

        $userModel->updateUser($id, [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'status' => $status
        ]);

        flash('success', 'Data pengguna berhasil diperbarui.');
        redirect('/admin/users');
    }

    public function usersDelete(int $id): void
    {
        $userModel = new UserModel();
        $userModel->deleteUser($id);
        flash('success', 'Pengguna berhasil dihapus.');
        redirect('/admin/users');
    }
}

