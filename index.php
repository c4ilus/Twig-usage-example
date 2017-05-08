<?php

require 'vendor/autoload.php';
require 'MyExtension.php';

// Routing.
$page = 'home';
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}

// Template rendering.
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, array(
  'cache' => __DIR__ . '/cache',
  //'cache' => FALSE,
  'debug' => TRUE
));
$twig->addExtension(new MyExtension());
$twig->addExtension(new Twig_Extensions_Extension_Text());
$twig->addGlobal('current_page', $page);

switch ($page) {
  case 'home':
    $values = array(
      'seo' => array(
        'title' => 'Home page',
      ),
      'person' => array(
        'name' => 'Romain'
      )
    );
    echo $twig->render('home.twig', $values);
    break;
  case 'contact':
    $values = array(
      'contact' => array(
        'name' => 'Romain',
        'email' => 'moro.romain@gmail.com'
      )
    );
    echo $twig->render('contact.twig', $values);
    break;
  case 'presentation':
    echo $twig->render('presentation.twig');
    break;
  case 'company':
    echo $twig->render('company.twig');
    break;
  default:
    header('HTTP/1.0 404 Not Found');
    echo $twig->render('404.twig');
    break;
}


