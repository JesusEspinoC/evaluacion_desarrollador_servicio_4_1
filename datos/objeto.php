<?php 
	/**
	 * Clase Objeto
	 */
	// Cambio de nombre a PascalCase por convencion
	class Objeto
	{		
		function __construct()
		{			
		}

		function ObtenerObjeto(){	
			// Se simplifica creacion y retorno de arreglo de datos
			return [
				[
					"tipo" => "carro", 
					"tamanio" => "Grande",
					"color" => "Green"
				],
				[
					"tipo" => "moto", 
					"tamanio" => "mediana",
					"color" => "Blue"
				],
				[
					"tipo" => "bicicleta", 
					"tamanio" => "chica",
					"color" => "Green"
				],
				[
					"tipo" => "avion", 
					"tamanio" => "grande",
					"color" => "yellow"
				],
				[
					"tipo" => "lancha", 
					"tamanio" => "grande",
					"color" => "Red"
				],
				[
					"tipo" => "moto", 
					"tamanio" => "mediano",
					"color" => "Red"
				]
			];
		}

		
	}
?>