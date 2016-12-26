<?php

$id = $_POST['searchId'];

$URI = 'http://mockeasj2.azurewebsites.net/UsedCarService.svc/Cars/' .$id;
$json = file_get_contents($URI);
$cars = json_decode($json);

print_r($cars);
require_once '../vendor/autoload.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array('auto_reload' => true));

$template = $twig -> loadTemplate('ShowAll.html.twig');
$twigContent = array('cars' => array($cars));

echo $template -> render($twigContent);

