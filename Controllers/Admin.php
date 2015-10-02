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

        /*$mail=new \PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dokolskij@gmail.com';
        $mail->Password = 'secret';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 465;
        $mail->setFrom('dokolskij@gmail.com', 'Andrei');
        $mail->addAddress('test@ya.ru', 'andrei');
        $mail->isHTML(true);
        $mail->Subject = 'Here is the subject';
        $mail->Body = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the HTML message body in bold!';
        if ($mail->send()){
            echo 'Письмо отправлено';
        }else{
            echo 'Письмо не может быть отправлено';
            echo 'Ошибка: '.$mail->ErrorInfo;
        }*/
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
