<?php

require_once '../vendor/autoload.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array('auto_reload' => true));

$template = $twig -> loadTemplate('createNew.html.twig');


//Read user input from index.html form
$model = $_POST['model'];
$price = $_POST['price'];
$year = $_POST['year'];

//Serialize it with JSON

$data = array("Model" => $model, "Price" => $price, "Year" => $year);
$json_data = json_encode($data);


//POST and CURL
$URI = 'http://mockeasj2.azurewebsites.net/UsedCarService.svc/Cars/';
$req = curl_init($URI);

curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($req, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json_data))
);
curl_setopt($req, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);

// sending request
$result = curl_exec($req);

// results, deserialize it an init twig
$json = file_get_contents($URI);
$cars = json_decode($json);
$twigContent = array('cars' => $cars);
echo $template->render($twigContent);





