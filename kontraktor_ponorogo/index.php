<?php

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.use_strict_mode', 1);
    session_start();
}

require_once __DIR__ . '/app/helpers.php';
require_once __DIR__ . '/app/core/Database.php';

$routes = [
    '/' => ['PageController', 'home'],
    '/tentang-kami' => ['PageController', 'about'],
    '/struktur-perusahaan' => ['PageController', 'structure'],
    '/layanan' => ['PageController', 'services'],
    '/portofolio' => ['PageController', 'portfolio'],
    '/kontak' => ['PageController', 'contact'],
    '/contact/store' => ['PageController', 'storeContact'],
    '/admin/login' => ['AuthController', 'login'],
    '/admin/logout' => ['AuthController', 'logout'],
    '/admin' => ['AdminController', 'index'],
    '/admin/houses' => ['AdminController', 'housesIndex'],
    '/admin/houses/create' => ['AdminController', 'housesCreate'],
    '/admin/houses/store' => ['AdminController', 'housesStore'],
    '/admin/services' => ['AdminController', 'servicesIndex'],
    '/admin/services/create' => ['AdminController', 'servicesCreate'],
    '/admin/services/store' => ['AdminController', 'servicesStore'],
    '/admin/projects' => ['AdminController', 'projectsIndex'],
    '/admin/projects/create' => ['AdminController', 'projectsCreate'],
    '/admin/projects/store' => ['AdminController', 'projectsStore'],
    '/admin/settings' => ['AdminController', 'settingsIndex'],
    '/admin/settings/store' => ['AdminController', 'settingsStore'],
    '/admin/structure' => ['AdminController', 'structureIndex'],
    '/admin/structure/store' => ['AdminController', 'structureStore'],
    '/admin/contacts' => ['AdminController', 'contactsIndex'],
    '/admin/testimonials' => ['AdminController', 'testimonialsIndex'],
    '/admin/testimonials/create' => ['AdminController', 'testimonialsCreate'],
    '/admin/testimonials/store' => ['AdminController', 'testimonialsStore'],
    '/admin/users' => ['AdminController', 'usersIndex'],
    '/admin/users/create' => ['AdminController', 'usersCreate'],
    '/admin/users/store' => ['AdminController', 'usersStore'],
];

$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$basePath = basePath();

if (str_starts_with($requestUri, $basePath)) {
    $requestUri = substr($requestUri, strlen($basePath));
}

$requestUri = rtrim($requestUri, '/') ?: '/';

$route = $routes[$requestUri] ?? null;

if ($route === null) {
    $dynamicPatterns = [
        '#^/admin/houses/edit/(\d+)$#' => ['AdminController', 'housesEdit', ['id']],
        '#^/admin/houses/update/(\d+)$#' => ['AdminController', 'housesUpdate', ['id']],
        '#^/admin/houses/delete/(\d+)$#' => ['AdminController', 'housesDelete', ['id']],
        '#^/admin/services/edit/(\d+)$#' => ['AdminController', 'servicesEdit', ['id']],
        '#^/admin/services/update/(\d+)$#' => ['AdminController', 'servicesUpdate', ['id']],
        '#^/admin/services/delete/(\d+)$#' => ['AdminController', 'servicesDelete', ['id']],
        '#^/admin/projects/edit/(\d+)$#' => ['AdminController', 'projectsEdit', ['id']],
        '#^/admin/projects/update/(\d+)$#' => ['AdminController', 'projectsUpdate', ['id']],
        '#^/admin/projects/delete/(\d+)$#' => ['AdminController', 'projectsDelete', ['id']],
        '#^/admin/testimonials/edit/(\d+)$#' => ['AdminController', 'testimonialsEdit', ['id']],
        '#^/admin/testimonials/update/(\d+)$#' => ['AdminController', 'testimonialsUpdate', ['id']],
        '#^/admin/testimonials/toggle/(\d+)$#' => ['AdminController', 'testimonialsToggle', ['id']],
        '#^/admin/testimonials/delete/(\d+)$#' => ['AdminController', 'testimonialsDelete', ['id']],
        '#^/admin/users/edit/(\d+)$#' => ['AdminController', 'usersEdit', ['id']],
        '#^/admin/users/update/(\d+)$#' => ['AdminController', 'usersUpdate', ['id']],
        '#^/admin/users/delete/(\d+)$#' => ['AdminController', 'usersDelete', ['id']],
        '#^/admin/contacts/status/(\d+)$#' => ['AdminController', 'contactsStatus', ['id']],
        '#^/admin/contacts/delete/(\d+)$#' => ['AdminController', 'contactsDelete', ['id']],
    ];

    foreach ($dynamicPatterns as $pattern => $config) {
        if (preg_match($pattern, $requestUri, $matches)) {
            $route = [$config[0], $config[1]];
            $_GET['id'] = $matches[1];
            $_POST['id'] = $matches[1];
            break;
        }
    }
}

if ($route === null) {
    http_response_code(404);
    echo '404 Not Found';
    exit;
}

[$controllerName, $method] = $route;

$controllerFile = __DIR__ . '/app/controllers/' . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(500);
    echo 'Controller not found';
    exit;
}

require_once $controllerFile;

$controller = new $controllerName();

if (!method_exists($controller, $method)) {
    http_response_code(500);
    echo 'Method not found';
    exit;
}

if ($requestUri === '/admin/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller->loginPage();
    exit;
}

if ($requestUri === '/admin/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->login();
    exit;
}

if ($requestUri === '/admin/logout') {
    $controller->logout();
    exit;
}

$refMethod = new ReflectionMethod($controller, $method);
if ($refMethod->getNumberOfParameters() > 0) {
    $paramId = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
    $controller->$method($paramId);
} else {
    $controller->$method();
}

