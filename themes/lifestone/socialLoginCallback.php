<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
		<?php
			include 'socialLoginSettings.php';
			
			$getString = http_build_query($_GET); // Se recogen todos los parámetros que han llegado por GET
			$postString = http_build_query($_POST);// Se recogen todos los parámetros que han llegado por POST
			$doubleResponse = $postString !="" && $getString!="" ? "&" : "";// Se decide si vamos a necesitar un "&" entre el posts y los gets.
			$queryVars = $getString . $doubleResponse . $postString;
			
			if( isset($_GET["redirectHash"]) ) {
				redirect($queryVars, "");// la red social utiliza # para pasar las variables a cliente. Necesitamos acceder a esas variables desde servidor.
			}else {    
				// $loginURL y $callbackURL están creadas en socialLoginSettings.php
				//	socialNetwork - La red social con la que el usuario quiere autentificarse.
				//	Actualmente los valores admitidos son: FB (facebook), LI (linkedin), TW (twitter), GO (google), IG (instagram)
				$url = (isset($_GET["socialNetwork"]) ? $loginURL : $callbackURL)  . "&" . $queryVars;
				
				$dataFromXeerpa = doCurl($url, null); // Llamamos a Xeerpa y esperamos un resultado como '{"errorCode":1, "url":"https://..." "fields":"someVar=someValue"}'
				$fromXeerpa = json_decode($dataFromXeerpa); // Transformamos la respuesta en un objeto
				if( $fromXeerpa -> errorCode != 1){
					// ErrorCode debe ser 1. Si es un número menor que cero es que algo ha salido mal.
					/* ACCIÓN: Debe hacer su propia implementación para manejar los errores;
					   por defecto redireccionamos al popup a un php que enseñe el error. 
					*/
					showError($fromXeerpa);
				}
				else if(!property_exists( $fromXeerpa, "fields")) {
					?><script>window.location = "<?php echo ($fromXeerpa -> url); ?>"</script><?php // Si no hay el campo fields simplemente hacemos una redirección del popup a la url indicada
				}
				else {
					$dataFromNetwork = doCurl($fromXeerpa -> url, $fromXeerpa -> fields); 	// Si hay fields hacemos un POST a la url indicada pasándole esa variable en el cuerpo del mensaje.
					redirect($queryVars, "data=" . $dataFromNetwork);
				}
			}
		?>
    </body>
</html>