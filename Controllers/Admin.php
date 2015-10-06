<?php
namespace Application\Controllers;
use Application\Models\News as NewsModel;
class Admin{
    public function actionNewsSave(){
    	include __DIR__ . '/../views/administrator/add.php';
    	$article=new NewsModel;
    	$article->id=$_POST['id'];
    	$article->title=$_POST['title'];
        $article->text=$_POST['text'];
        $article->save();
    }
    
    public function actionNewsDelete(){
    	include __DIR__ . '/../views/administrator/delete.php';
    	$article=new NewsModel;
        $article->id=$_POST['id'];
        $article->delete();
    }
    public function actionReadLog(){
        $file=file_get_contents('fileLog.txt');
        echo $file;
    }
}
