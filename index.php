<?php header('Content-Type: text/html; charset=utf-8');

/*$content=file_get_contents(__DIR__ .'/test.json');
$obj=json_decode($content);
echo $obj->foo;*/

/*$obj=new stdClass;
$obj->title='Test';
$obj->text='Длинный текст';
echo json_encode($obj);

die;*/

require __DIR__ . '/autoload.php';

$path=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathParts=explode('/', $path);

$ctrl=!empty($pathParts[1])?ucfirst($pathParts[1]):'News';
$act=!empty($pathParts[2])?ucfirst($pathParts[2]):'All';

$controllerClassName='Application\\Controllers\\'.$ctrl;

//echo $controllerClassName;die;

try{
	$controller=new $controllerClassName;
	$method='action'.$act;
	$controller->$method(); 
}
catch (PDOException $error){
	$log=new Log($error);
	$log->errLog();
	$view=new View;
	$view->error=$error->getMessage();
	$view->display('/error403.php');
	die;	
}
catch (E404Exception $e){
	$log=new Log($e);
	$log->errLog();
	$view=new View;
	$view->error=$e->getMessage();
	$view->display('/error404.php');
	die('Что-то пошло не так:' . $e->getMessage());
}
