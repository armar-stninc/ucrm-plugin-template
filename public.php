<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/users.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$configManager = \Ubnt\UcrmPluginSdk\Service\PluginConfigManager::create();
$config = $configManager->loadConfig(); // usage (from manifest): $var = $config['var'];
$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader);
// Uncomment the following line if this is a user facing plugin. Admin users are privileged users and not regular users and will not have these attributes.
//$user = new User; //returns $user->id, username, internalUserId, isClient, userGroup, firstName, lastName, cmdbCompanyId, primaryAccountId, email

$action = false;
$menu_selection = false;

if (!empty($_GET)) {
    $action = $_GET['ucrm_action'];
}
if (!empty($_POST)) {
    $action = $_POST['ucrm_action'];
}

// Routing workaround. Ubiquiti only routes to public.php for plugins?
switch ($action) {
    case "":
        include 'app/index.php';
        break;
    case "reload":
        include 'app/index.php';
        break;
    case "create":
        include 'app/create.php';
        break;
    case "edit":
        include 'app/edit.php';
        break;
    case "create_product":
        include 'app/new_product.php';
        break;
    case "update":
        include 'app/update.php';
        break;
    case "addons":
        include 'app/addons.php';
        break;
    case "menu":
        $menu_selection = $_GET['menu'];
        switch ($menu_selection) {
            case "Menu Item 2":
                include 'app/index.php';
                break;
            case "Parts":
                include 'app/products.php';
                break;
            case "Add-ons":
                include 'app/addons.php';
                break;
        };
        break;

};
