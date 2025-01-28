<?php

namespace Teleinforma;

use Teleinforma\Db\Database;
use \PDO;

class Companies{

    public $id;
    public $name;
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

    public function create(){

    }

    public static function get($where = null, $order = null, $limit = null){
        return (new Database('companies'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);

    }
    public function update(){

    }

    public function delete(){

    }
}

?>