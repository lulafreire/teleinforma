<?php

use Teleinforma\Companies;

$app->get('/api/companies', function() { 
	
    $companies = Companies::get();

    echo $companies != null ? json_encode($companies) : "Nenhum resultado obtido.";
	
});

?>