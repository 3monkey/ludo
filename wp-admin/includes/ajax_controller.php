<?php

function listGames(){
	global $wpdb;

	$query = "SELECT 	g.game_id,
						g.titulo, 
						c.categoria,  
						n_jugadores,
						duracion,
						a.autor,
						e.editoarial,
						u.user_nickname	
			FROM $wpdb->games AS g
			INNER JOIN $wpdb->categorias c ON c.categoria_id = g.categoria
			INNER JOIN $wpdb->autores 	 a ON a.autor_id = g.autor
			INNER JOIN $wpdb->editoriales e ON e.editorial_id = g.editorial
			INNER JOIN $wpdb->users u ON u.ID = g.usuario
			WHERE g.anulado = 0";
	$params = [];

	$games = $wpdb->get_results(sprintf($query,$params));

	return $games;
}

function listAutores(){
	global $wpdb;

	$query = "SELECT a.autor_id,
					 a.autor
			FROM ludo.wp_autores a
			WHERE a.anulado = 0";

	$autores = $wpdb->get_results(sprintf($query,$params));

	return $autores;
}

function listCategorias(){
	global $wpdb;

	$query = "SELECT c.categoria_id,
					 c.categoria
			FROM ludo.wp_categorias c
			WHERE c.anulado = 0";

	$categorias = $wpdb->get_results(sprintf($query,$params));

	return $categorias;
}

function listEditoriales(){
	global $wpdb;

	$query = "SELECT e.editorial_id,
					 e.editorial
			FROM ludo.wp_editoriales e
			WHERE e.anulado = 0";

	$editoriales = $wpdb->get_results(sprintf($query,$params));

	return $editoriales;
}

function listUserGames(int $user_id){
	global $wpdb;

	$query = "SELECT g.game_id, 
					 g.titulo, 
					 c.categoria,
					 c.categoria_id, 
					 g.n_jugadores, 
					 g.duracion, 
					 a.autor, 
					 a.autor_id,
					 e.editorial,
					 e.editorial_id,
					 convert(g.anulado,integer) as anulado, 
					 u.user_nicename	
			FROM ludo.wp_games g			
				INNER JOIN ludo.wp_categorias c ON c.categoria_id = g.categoria
				INNER JOIN ludo.wp_autores 	 a ON a.autor_id = g.autor
				INNER JOIN ludo.wp_editoriales e ON e.editorial_id = g.editorial
				INNER JOIN ludo.wp_users u ON u.ID = g.usuario
			WHERE g.usuario = %d ";
			
	$params = [$user_id];

	$games = $wpdb->get_results(sprintf($query,$params));

	return $games;
}

function getGame(int $id){
	global $wpdb;

	$query = "SELECT 	g.game_id
						g.titulo, 
						c.categoria,  
						g.n_jugadores,
						g.duracion,
						a.autor,
						e.editorial,
						u.user_nickname	
			FROM $wpdb->games AS g
			INNER JOIN $wpdb->categorias c ON c.categoria_id = g.categoria
			INNER JOIN $wpdb->autores 	 a ON a.autor_id = g.autor
			INNER JOIN $wpdb->editoriales e ON e.editorial_id = g.editorial
			INNER JOIN $wpdb->users u ON u.ID = g.usuario
			WHERE game_id = %d AND g.anulado = 0";
	$params = [$id];

	$games = $wpdb->get_row($wpdb->prepare($query,$params));

	return json_encode($games);
}

function updateGame(int $id, array $datos){
	global $wpdb;

	$params = [];

	$query = "UPDATE ludo.wp_games SET ";



	foreach($datos as $key => $value){
		$params[] = $value;
		$query .= (is_int($value)) ? " $key = %d ,": " $key = %s,";
	}

	$query = substr($query, 0, -1);

	$params[] = $id;
	$query .= " WHERE game_id = %d";
	

	$result = $wpdb->query($wpdb->prepare($query,$params));

	return $result;
}

function saveGame(array $datos){
	global $wpdb;

	$query = "INSERT ludo.wp_games (titulo,categoria,n_jugadores,duracion,autor,editorial,usuario) VALUES (%s,%d,%s,%s,%d,%d,%d)";
	$params = $datos;

	$result = $wpdb->query($wpdb->prepare($query,$params));

	return $result;
}

function deleteGame(int $id){
	global $wpdb;

	$query = "DELETE $wpdb->games WHERE game_id = %d";
	$params = [$id];

	$result = $wpdb->query($wpdb->prepare($query,$params));

	return $result;
}

function setStateGame(int $id, int $state = 0){
	global $wpdb;

	$query = "UPDATE $wpdb->games SET anulado = %d WHERE game_id = $d ";
	$params = [$state, $id];

	$result = $wpdb->query($wpdb->prepare($query,$params));

	return $result;
}

function loadCsv(string $file){
	
}

function downloadCsv(int $id = 0){

	if(empty($id)){
		$games = listGames();
	}else{
		$games = listUserGames($id);
	}

}
?>