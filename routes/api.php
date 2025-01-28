<?php

use Teleinforma\Companies;

$app->get('/api', function() { 
	
    echo "
    
    <form method='post' action='api/company/create' enctype='multipart/form-data'>

    <input type='text' name='name' placeholder='Nome da empresa'><br>
    <input type='text' name='category' placeholder='nº Categoria'><br>
    <input type='text' name='phone_01' placeholder='Fone 1'><br>
    <input type='text' name='phone_02' placeholder='Fone 2'><br>
    <input type='text' name='phone_03' placeholder='Fone 3'><br>
    <input type='text' name='latitude' placeholder='Latitude'><br>
    <input type='text' name='longitude' placeholder='Longitude'><br>
    <input type='text' name='description' placeholder='Descrição'><br>
    <input type='text' name='site' placeholder='Site'><br>
    <input type='text' name='instagram' placeholder='Instagram'><br>
    <input type='text' name='facebook' placeholder='Facebook'><br>
    <input type='text' name='whatsapp' placeholder='WhatsApp'><br>
    <input type='text' name='tags' placeholder='Tags'><br>
    <input type='file' name='image'>
    <input type='submit' value='Gravar'>

    </form>
    
    ";
	
});

$app->get('/api/companies', function() { 
	
    $companies = Companies::get();

    echo $companies != null ? json_encode($companies) : "Nenhum resultado obtido.";
	
});

$app->post('/api/company/create', function() { 
	
    $create = Companies::create($_POST);

    return json_encode($create);

	
});

?>