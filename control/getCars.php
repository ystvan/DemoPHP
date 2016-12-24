<?php
/**
 * Created by PhpStorm.
 * User: IstvanMarki
 * Date: 23-Dec-16
 * Time: 5:59 PM
 */

$URI = 'http://mockeasj2.azurewebsites.net/UsedCarService.svc/Cars';
$json = file_get_contents($URI);
$cars = json_decode($json);

require_once '../vendor/autoload.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array('auto_reload' => true));

$template = $twig -> loadTemplate('ShowAll.html.twig');
$twigContent = array('cars' => $cars);

echo $template -> render($twigContent);
