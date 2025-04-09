<?php  
	/**
	 * Clase Valida
	 */
	// Cambio de nombre a PascalCase por convencion
	class Valida
	{
		private $response = array();
		private $rutatemp = "temp/";
		public function __construct()
		{			
		}
		// Se añade $objetoNombre para hacer mas versatil la informacion devuelta en caso exitoso. Alternativamente se puede crear un case para cada "tipo" de consulta GET. Pero esto es mas resumido.
		public function CreaRespuesta($codigo, $mensaje = "", $objeto = null, $objetoNombre = "listaobjetos"){
			switch ($codigo) {
				case '0':
					$this->response["codigo_respuesta"] = 0;
					$this->response["mensaje"] = "Ok";
					// Añadir if para omitir en caso de que objeto sea null
					if(isset($objeto)){
						$this->response[$objetoNombre] = $objeto;
					}
					break;				
					// Añadir case para caso tipo != 1 en clase Api.php, que utiliza la funcion exportar de la misma clase			

				default: // Reemplazar case para que sea más versatil al enviar codigos de error.
					$this->response["codigo_respuesta"] = $codigo;
					$this->response["mensaje"] = $mensaje;
					break;
			}
		}

		public function ObtenerResponse(){
			//Aqui se retorna la respuesta
			// Se añade return con atributo "response" del objeto, con banderas para respuesta JSON
			return json_encode($this->response, JSON_PRETTY_PRINT  | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		}

		public function ExportarJson($nombreArchivo){			
			file_put_contents($this->rutatemp .$nombreArchivo, json_encode($this->response), FILE_APPEND | LOCK_EX);
		}
	}
?>