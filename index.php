<?php

//Notas Rapidas
//Index.php debe ser el esqueleto, debe estar desnudo como se pueda hacer ya que será reenviado cada vez que se
//cargue una nueva pagina

require_once 'model/database.php';
session_start();   //Inicia sesion o reanuda, para recuperar los datos de sesion existens: $_SESSION[]

//$_REQUEST es una variable de solicitud HTTP que esta disponible en cualquier parte del script
if (isset($_REQUEST['c']) == 'Login' && isset($_REQUEST['a']) == 'IniciarSesion') {
    //isset: determina si una variable esta definida y no es null --> true

    //si existe una supervariable que este definida con una 'c' (controlador) que es igual a 'Login' y que
    //la accion que este definida con una 'a' (accion) que es igual a IniciarSesion entonces se ingresa  a la condicion

    // Obtenemos el controlador que queremos cargar
        $controller = strtolower($_REQUEST['c']);  //la variable del controlador es igual a la supervariable 'c' en minusculas
        
        
        //operador ternario: (condicion ? resultado1 : resultado2)
        //https://docs.microsoft.com/es-es/dotnet/csharp/language-reference/operators/conditional-operator
        //si la condicion es verdadera entonces el valor es resultado1, cuando es falso el valor es resultado2
        //en este caso solo se evalua el primer resultado ya que se esta asignando $accion = isset($_REQUEST['a'])
        //mas no se esta evaluando condicion:  $accion == isset($_REQUEST['a'
        $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
        //accion será igual a $_REQUEST['a']; en este caso a IniciarSesion


            // Instanciamos el controlador
            require_once "controller/$controller.controller.php";
            $controller = ucwords($controller) . 'Controller';
            $controller = new $controller;
            
            //Invoca a una llamada de retorno, que esta definido por los arrays $controller y $accion
            call_user_func( array( $controller, $accion ) );
        
}  else

{
    
    //Por aqui comienza todo..........
    
    //$_SESSION es una variable de sesion disponible para todo el script
    //empty determina si una variable es nula --> true

    //(si la variable de session user no esta definida pero tiene un valor no nullo) o  (tiene valor nulo) entonces ingresa a la condicion
    if(!isset($_SESSION["user"]) || empty($_SESSION["user"])){

        //se le asigna el controlador login
        $controller = 'login';

        require_once "controller/$controller.controller.php";

        //ucwords: convierte en mayuscula solo el primer caracteres
        $controller = ucwords($controller) . 'Controller';
        $controller = new $controller;
        $controller->Index(); //Login.Controller->Index()

    } else
    {
        
        $controller = 'inicio';

        // Todo esta lógica hara el papel de un FrontController
        //Es un patron de diseño de sotware en que consiste que el usuari puede acceder a un unico
        //punto de acceso que es el index.php, a diferencia de las aplicaciones web clasicas
        //donde el usuario podia ejecutar cualquier script solo referenciadolo en la barra de direcciones


        if(!isset($_REQUEST['c']))
        {


            //si $_REQUEST['c'] no esta definido, entonces ingresa a esta condicion
            //en la cual se ejecuta el controlador de inicio
            require_once "controller/$controller.controller.php";
            $controller = ucwords($controller) . 'Controller';
            $controller = new $controller;
            $controller->Index();    
   
        }
        else
        {            
            //si $_REQUEST['c'] ya esta definido y tiene un valor diferente de nulo, entonces ingresa a esta condicion
            

                    // Obtenemos el controlador que queremos cargar
                    $controller = strtolower($_REQUEST['c']);
                    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
                    

                    // Instanciamos el controlador
                    require_once "controller/$controller.controller.php";
                    $controller = ucwords($controller) . 'Controller';
                    $controller = new $controller;
                    

                    // Llama la accion
                    call_user_func( array( $controller, $accion ) );

        }

    }

}
