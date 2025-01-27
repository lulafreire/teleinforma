<?php 
session_start();

header('Content-Type: text/html; charset=UTF-8');

require_once("vendor/autoload.php");
require("functions.php");

use Teleinforma\Favorites;
use Teleinforma\Page;
use Teleinforma\Users;
use Teleinforma\Vaga;
use Teleinforma\Links;
use Slim\Slim;

$app = new \Slim\Slim();

	

$app->config('debug', true);

include __DIR__.'/routes/files.php';
include __DIR__.'/routes/digital.php';
include __DIR__.'/routes/team.php';
include __DIR__.'/routes/login.php';
include __DIR__.'/routes/links.php';
include __DIR__.'/routes/forms.php';
include __DIR__.'/routes/profile.php';
include __DIR__.'/routes/attachments.php';

$app->get('/', function() {

	// Verifica se há usuário logado
	Users::verifyLogin();

	// Identifica o usuário logado
	$user = myArray($_SESSION[Users::SESSION]);
	
	if($user['id'] !='999'){

		// Verifica os atalhos favoritos do usuário logado
		$favorites = myArray(Favorites::getFavorites($user['id']));		

	} else {
		$favorites = '';
	}

	// Links Mais Acessados
	$hitLinks = myArray(Links::getHitsLinks(null,'hits DESC',8));
	$linksSistemas = myArray(Links::getlinks('type=1','title'));
	$linksExternos = myArray(Links::getlinks('type=3','title'));	
	$linksForms = myArray(Links::getlinks('type=2','title'));
	$linksManuais = myArray(Links::getlinks('type=4','title'));
	
	// Todos os links
	$allLinks = myArray(Links::getLinks(null,'title'));

	//echo "<pre>"; print_r($favorites); echo "</pre>"; exit;
   
	$page = new Page([
		'header'=>false,
		'footer'=>false
	]);

	$page->setTpl("index", [
		'title'=>'APS Irecê/BA',
		'user'=>$user,
		'linksSistemas'=>$linksSistemas,
		'linksExternos'=>$linksExternos,
		'linksForms'=>$linksForms,
		'linksManuais'=>$linksManuais,
		'hitLinks'=>$hitLinks,
		'favorites'=>$favorites,
		'allLinks'=>$allLinks
	]);

});

$app->get('/cadastrar', function() {    
	
	$page = new Page([
		'header'=>false,
		'footer'=>false
	]);

	$page->setTpl("vagas-create", [
		'title'=>'Team'
	]);

});

$app->post('/gravar', function() {
			
	$vaga = new Vaga;
	$vaga->cadastrar();

	header("Location: index.php");
	exit;

});



$app->run();

 ?>