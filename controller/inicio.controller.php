<?php

class InicioController {

    //Este controlador de Inicio nos dirije a la vista de Inicio siguendo en patron MVC
	public function Index(){
        require_once 'view/inicio/inicio.php';
        require_once 'view/footer.php';
    }
}