<?php

use Dompdf\Dompdf;

require_once 'model/setting.php';
require_once 'model/profesor.php';
require_once 'vendor/autoload.php'; //cargando todos los archivos del composer
//https://www.youtube.com/watch?v=6G6mleD2cYk video para agregar el dompdf

//quiero que se genere un archivo.pdf
ob_start();



class ReporteController 
{
	public $model_setting;
	public $model_profesor;

	public function __CONSTRUCT(){

		$this->model_setting = new Setting();    
    	$this->model_profesor = new Profesor();
    }

	private function ListarDatosEmpresa()
	{
		return $this->model_setting->Listar();

	}

	private function GenerarPDF($vista_html)
	{
		$dompdf = new Dompdf();
		
		$dompdf->loadHtml($vista_html);

		$dompdf->setPaper('A4', 'portrait'); //landscape

		$dompdf->render();

		$dompdf->stream(); 
	}

	public function ReporteProfesores()
	{

		$empresas = $this->ListarDatosEmpresa(); 
		
		$profesores = $this->model_profesor->Listar();

		$html_cabecera =  $this->HtmlCabeceraReporte($empresas);

		$thml_detalle = $this->HtmlDetalleReporteProfesores($profesores);		
		
		$this->GenerarPDF($html_cabecera . $thml_detalle);

	}

	private function HtmlDetalleReporteProfesores($profesores) 
	{
		$vista_html ="";
		$vista_detalle_html = "";
		$vista_html = $vista_html . 
					"<h1 style='text-align:center; font-weight:bold;'> Listado de Profesores</h1>
					 <table cellspacing='0' style='width: 100%; text-align: left; font-size: 10pt;'>
        				<tr>
				            <th style='width: 10%;text-align: center;background:#2c3e50;padding: 4px 4px 4px;color:white;
				            	font-weight:bold;font-size:12px;'>Nombres</th>
				            <th style='width: 40%;text-align: left;background:#2c3e50;padding: 4px 4px 4px;color:white;
				            	font-weight:bold;font-size:12px;'>Apellido Paterno</th>
				            <th style='width: 25%;text-align: left;background:#2c3e50;padding: 4px 4px 4px;color:white;
				            	font-weight:bold;font-size:12px;'>Apellido Materno</th>
				            <th style='width: 25%;text-align: left;background:#2c3e50;padding: 4px 4px 4px;color:white;
				            	font-weight:bold;font-size:12px;'>DNI</th>
				        </tr>";

 	 	 foreach ($profesores as $profesor) 
 	 	 {

		    $vista_detalle_html = $vista_detalle_html . 
		 
		    	"<tr>
		            <td  style='width: 10%; text-align: center'>" . $profesor->Nombres . "</td>
		            <td  style='width: 40%; text-align: left'>" . $profesor->ApellidoPaterno . "</td>
		            <td  style='width: 25%; text-align: left'>" . $profesor->ApellidoMaterno . "</td>
		            <td  style='width: 25%; text-align: left'>" . $profesor->dni . "</td>       
		        </tr>";
  		}
	  
        $vista_html = $vista_html . $vista_detalle_html ."</tr></table></body></html>";
		
		return $vista_html;
	}

	private function HtmlCabeceraReporte($empresas)
	{
		$vista_html ="";
		$vista_html = $vista_html . 
					"<!DOCTYPE html>
					<html lang='es'>
 						<head>
 							<meta charset='UTF-8'>
 							<title>Reporte de Listado de Alumnos</title>
 						</head>
 						<body>
 							<table cellspacing='0' style='width: 100%;'>
 							        <tr>";

 							        	$vista_html = $vista_html . "<td style='width: 75%; color: #34495e;font-size:12px;text-align:center'>
		 					                <span style='color: #34495e;font-size:14px;font-weight:bold'>
		 					                	  " .  $empresas[0]->ph_name ."
		 					                </span>
		 					                 <br>  " . $empresas[0]->ph_caracteristicas ."  
		 					                 <br>RUC: " .  $empresas[0]->ph_ruc ."   
		 									 <br>   " . $empresas[0]->ph_address ."<br>
		 									 Teléfono:   ". $empresas[0]->ph_telephone ."<br>
		 									 Email:   ". $empresas[0]->ph_email ."
		 					             </td>
	 					        </tr>
							</table><br>";
		return $vista_html;
	}




}




