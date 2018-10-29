<?php

try{

	include_once('includes/ajax_controller.php');
	include_once('../wp-config.php');
	include_once('../wp-load.php');

	$data = [
		'error' => 0,
		'messagge' => '',
		'data' => []
	];

	if (!empty($_POST['action'])){

		$accion = $_POST['action'];
	}else{

		throw new Exception('No se ha definido una acción');
	}	
	$user = wp_get_current_user();
	if (empty($user) || !isset($user)){
		throw new Exception('User Not Login');
	}
	if (empty($accion)){
		throw new Exception('Acction not defined');
	}
switch ($accion) {
	case 'init':
		try{
			$data['data']['games'] = listUserGames($user->ID);
			$data['data']['autores'] = listAutores();
			$data['data']['categorias'] = listCategorias();
			$data['data']['editoriales'] = listEditoriales();
		}catch(Excption $e){
			$data['error'] = 1;
			$data['messagge'] = $e->getMessage();
		}
	break;
	case 'listGames':
		try{
			$data['data'] = listUserGames($user->ID);
		}catch(Excption $e){
			$data['error'] = 1;
			$data['messagge'] = $e->getMessage();
		}
		break;
	case 'editLine':
		try{
			if(	empty($_POST['id_game']) ||
				empty($_POST['i_game']) ||
				empty($_POST['i_categoria']) ||
				empty($_POST['i_duracion']) ){
				throw new Exception("Error en el envío de los datos");
			}
			$datos = [$_POST];
			$id = $_POST['id_game'];
			$object = array_map(function($row){
				$obj = [];
				$obj['titulo'] = $row['i_game'] ;
				$obj['categoria'] = $row['i_categoria'] ;
				$obj['duracion'] = $row['i_duracion'] ;
				$obj['n_jugadores'] = $row['i_njugadores'] ;
				$obj['autor'] = (!empty($row['i_autor'])) ? $row['i_autor']: 1;
				$obj['editorial'] = (!empty($row['i_editorial'])) ? $row['i_editorial']: 1;
				$obj['anulado'] = (isset($row['i_anulado'])) ? (int)$row['i_anulado']: 0;
				return $obj;
			},$datos);
			if(!updateGame($id,$object[0])){
				$data['error'] = 1;
				throw new Exception("Se ha producido un error al actualizar los datos");
			}
			$data['data']['games'] = listUserGames($user->ID);
		}catch(Exception $e){
			$data['error'] = 1;
			$data['messagge'] = $e->getMessage();
		}
		break;
	case 'newLine':
		try{
			if(	empty($_POST['i_game']) ||
				empty($_POST['i_categoria']) ||
				empty($_POST['i_duracion']) ){
				throw new Exception("Error en el envío de los datos");
			}
			$datos = [$_POST];
			$object = array_map(function($row){
				$obj = [];
				$obj['titulo'] = utf8_encode(trim($row['i_game'])) ;
				$obj['categoria'] = $row['i_categoria'] ;
				$obj['duracion'] = utf8_encode(trim($row['i_duracion'])) ;
				$obj['n_jugadores'] = utf8_encode(trim($row['i_njugadores'])) ;
				$obj['autor'] = (!empty($row['i_autor'])) ? $row['i_autor']: 1;
				$obj['editorial'] = (!empty($row['i_editorial'])) ? $row['i_editorial']: 1;
				return $obj;
			},$datos);
			
			$object[0]['usuario'] = $user->ID;

			if(!saveGame($object[0])){
				$data['error'] = 1;
				throw new Exception("Se ha producido un error al actualizar los datos");	
			}
			$data['data']['games'] = listUserGames($user->ID);
		}catch(Exception $e){
			$data['error'] = 1;
			$data['messagge'] = $e->getMessage();
		}
		break;
	case 'deleteLine':
		try{
			if(	empty($_POST['id_game'])){
				throw new Exception("Error en el envío de los datos");
			}
			$id = $_POST['id_game'];
			$object = [];
			$object['anulado'] = 1;

			if(!updateGame($id, $object)){
				$data['error'] = 1;
				throw new Exception("Se ha producido un error al anular el registro.");	
			}
			$data['data']['games'] = listUserGames($user->ID);
		}catch(Exception $e){
			$data['error'] = 1;
			$data['messagge'] = $e->getMessage();
		}
		break;
	case 'changeStateGame':
		try{
			if(empty($_POST['id']) || !isset($_POST['id'])){
				throw new Exception("");
			}
			if(empty($_POST['state']) || !isset($_POST['state'])){
				throw new Exception("");
			}
			$id = '';
			$state = '';
			if(setStateGame($id,$state)){
					echo json_encode($data);
			}else{
				throw new Exception('');
			}
		}catch(Excption $e){
			$data['error'] = 1;
			$data['messagge'] = $e->getMessage();
		}
		break;
	case 'listLine':
		break;
	default:
		# code...
		break;
	}
}catch(Exception $e){
	$data['error'] = 1;
	$data['messagge'] = $e->getMessage();
}finally{
	echo json_encode($data);
}

?>