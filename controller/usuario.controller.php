<?php
require_once 'model/funcionesImportantes.php';
require_once 'vendor/autoload.php';
require_once 'controller/solicitudesbajas.controller.php';


class UsuarioController extends SolicitudesbajasController{


    //Funcion para dirigirnos a la vusta de envio de solicitudes de baja
    public function BajarUsuario(){
        require_once 'view/inicio/inicio.php';
        require_once 'view/usuario/bajarusuario.php';
        require_once 'view/footer.php';
    }

    public function BajaExitosa(){
        require_once 'view/inicio/inicio.php';
        require_once 'view/usuario/bajaexitosa.php';
        require_once 'view/footer.php';
    }


    public function EnviarBajarUsuario(){
        $Asunto = $_REQUEST['txtTipoSolicitud'];
        $para= $_REQUEST['txtEmail'];
        $mensaje= $_REQUEST['txtMsg'];

        enviar_correo_electronico($Asunto,$para,$mensaje);
        SolicitudesbajasController::Guardar();
        
      
    }

    

   


}

?>