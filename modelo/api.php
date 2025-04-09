<?php 
	/**
	 * 
	 */
	require_once('modelo/Valida.php');
	require_once('datos/Objeto.php');
	// Cambio de nombre a PascalCase por convencion
	class Api
	{
		private $metodo = null;
		
		public function __construct($metodo)
		{			
			$this->metodo = $metodo;			
		}

		// Cambio de nombre a PascalCase por convencion
		public function Call(){
			// Se añade objeto "valida" para respuestas
			$validar = new Valida(); // Cambio de nombre a camelCase por convencion
			try {
				$tipo = "1";
				if(isset($_GET['tipo'])){
					$tipo = $_GET['tipo'];
				}
				if(isset($_GET['nombre'])){
					$nombre = $_GET['nombre'];
				}

				switch ($this->metodo) {
					case 'GET':
						if($tipo == "1"){
							return $this->MetodoGet();
						}else{
							return $this->Exportar($nombre);
						}
						break;			
					default:
						// Se añade response para metodo no permitido
						$validar->CreaRespuesta("405", "Método no permitido");					
						break;
				}				
			} catch (Exception $e) {
				// Se añade respuesta en catch. Se podría añadir mensaje de excetion, pero se omitira por seguridad.
				$validar->CreaRespuesta("-1", "Ocurrio un error.");
			}
			return $validar->ObtenerResponse();		
		}

		public function MetodoGet(){			
			// Mover lineas de objeto fuera de try para utilizarlas en catch y return
			$objetoColor = new Objeto(); // Cambio de nombre a camelCase por convencion			
			$validar = new Valida(); // Cambio de nombre a camelCase por convencion

			try {
				// Se reemplaza valor de array vacío con llamada a metodo ObtenerObjeto.
				$Valor = $objetoColor->ObtenerObjeto();
				
				$validar->CreaRespuesta("0", "", $Valor);
				
				// Se mueve esta linea a metodo ObtenerResponse de clase "Valida"
				// echo json_encode($validar->ObtenerResponse(), JSON_PRETTY_PRINT  | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
			} catch (Exception $e) {
				//Se elimina tercer parametro porque es null por default
				$validar->CreaRespuesta("-1", "Error");
			}
			// Ajustar para que directamente se retorne la respuesta con metodo ObtenerResponse
			return $validar->ObtenerResponse();
		}
		// Cambio de nombre a PascalCase por convencion
		public function Exportar($nombreArchivo){
			try{

				$objeto = new Objeto(); // Añadir creación de objeto "Objeto". Cambio de nombre a camelCase por convencion. Cambio de nombre por irrelevancia de nombre previo
				$validar = new Valida(); // Cambio de nombre a camelCase por convencion
				$rutatemp = "temp/";
				$valorObjeto = $objeto->ObtenerObjeto(); // Cambio de nombre a camelCase por convencion

				$nombreArchivo = $nombreArchivo . ".json";
				file_put_contents($rutatemp . $nombreArchivo, json_encode($valorObjeto), FILE_APPEND | LOCK_EX);
				$fileName = basename($nombreArchivo);
				// Correccion a ruta de archivo
				$filePath = $rutatemp . $fileName;
				if(!empty($fileName) && file_exists($filePath)){

					//Define header information
					header('Content-Description: File Transfer');
					header('Content-Type: txt/html');
					header("Cache-Control: no-cache, must-revalidate");
					header("Expires: 0");
					header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
					header('Content-Length: ' . filesize($filePath));
					header('Pragma: public');
					//Clear system output buffer
					flush();

					//Read the size of the file
					readfile($filePath);

					//Terminate from the script
					die();

					// Ajuste deshabilitado, que sirve para exportar como JSON en caso de querer consistencia. 
					// Comentar lineas de header, readfile y die, y descomentar la siguiente con metodo CreaRespuesta para habilitar
					// // Contenido exportado como string debido a que, de la forma en que se guarda, no forma un JSON valido. Pero se podria ajustar para exportar como parte del JSON.
					// $validar->CreaRespuesta("0", "", str_replace("\"", "'", file_get_contents($filePath)), "archivo");
					
				}
			}catch(Exception $e) {
				// Se elimina tercer parametro porque es null por default
				$validar->CreaRespuesta("-1", "Error");
			}
			return $validar->ObtenerResponse();
		}

	}
?>