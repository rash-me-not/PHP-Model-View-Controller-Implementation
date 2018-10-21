
<?php

use AztecGameStudios\core\Router;
use AztecGameStudios\core\Requests;

// Autoloading Composer Libraries
require_once __DIR__ . '\..\vendor\autoload.php';

$router = new Router();
$response = $router->route(new Requests());
echo $response;

// Include footer 
include '..\views\footer.php';
?>

