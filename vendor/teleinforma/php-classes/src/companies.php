<?php

namespace Teleinforma;

use Teleinforma\Db\Database;
use \PDO;

class Companies{

    public $id;
    public $name;
    public $category;
    public $phone_01;
    public $phone_02;
    public $phone_03;
    public $latitude;
    public $longitude;
    public $description;
    public $image;
    public $site;
    public $instagram;
    public $facebook;
    public $whatsapp;
    public $hits;
    public $tags;

    public static function create(){

        // Tratamento da imagem
        $dir = "assets/images/companies"; 
        // recebendo o arquivo multipart 
        $file = $_FILES["image"]; 
        // extensão
        $ext = explode('.',$file['name']);
        $ext = end($ext);        
        // muda o nome do arquivo
        $fileName = "img".date('dmY-his').".$ext";
        // move para a pasta selecionada
        move_uploaded_file($file["tmp_name"], "$dir/".$fileName);

        $sql = (new Database('companies'))->insert([
            'name'=>$_POST['name'],
            'category'=>$_POST['category'],
            'phone_01'=>$_POST['phone_01'],
            'phone_02'=>$_POST['phone_02'],
            'phone_03'=>$_POST['phone_03'],
            'latitude'=>$_POST['latitude'],
            'longitude'=>$_POST['longitude'],
            'description'=>$_POST['description'],
            'site'=>$_POST['site'],
            'instagram'=>$_POST['instagram'],
            'facebook'=>$_POST['facebook'],
            'whatsapp'=>$_POST['whatsapp'],
            'hits'=>0,
            'tags'=>$_POST['tags'],
            'image'=>$fileName,
        ]);         
 
        return $sql;
    }

    public static function get($where = null, $order = null, $limit = null){
        return (new Database('companies'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);

    }
    public function update(){

    }

    public function updateImage(){

    }

    public function delete(){

    }

    public function uploadImage(){

    }
}

?>