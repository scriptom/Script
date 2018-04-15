 <?php 
 echo "<pre>";	var_dump($_POST); echo "</pre>";
 // foreach ($_POST['ft_campopart'] as $id => $value) 
 // 	$newArr[$value] = $_POST['ft_nombreresp'][$id]; 
	
 // echo "<pre>"; var_dump($newArr); echo "</pre>";
if (!empty($_POST['ft-entries'])) {
	$ft = $_POST['ft-entries'];
}
if (!empty($_POST['lug-entries'])) {
	$lug = $_POST['lug-entries'];
}
if (!empty($_POST['dbid'])) {
	$dbid = $_POST['dbid'];
}
if (!empty($_POST['propuesta_sinopsis'])) {
	$sinopsis = $_POST['propuesta_sinopsis'];
}
if (!empty($_POST['pel_titulo'])) {
	$titulo = $_POST['pel_titulo'];
}
if(!empty($_POST['generos'])) {
	$generos = $_POST['generos'];
}
if (!empty($_POST['tematicas'])) {
	$tematicas = $_POST['tematicas'];
}



?>