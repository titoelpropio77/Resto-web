<?php 


    $conexion = new mysqli('localhost','posgourmet','root','posgourmet',3306);
	if (!$conexion){ 
		echo "<script>
			alert('holi');
		</script>";
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	

	if ($_POST['proceso']==="listar") {
	$query = "SELECT id,nom_prod  FROM productos_mysql";
	
	}

	$resultado = $conexion->query($query);
     if (!$resultado) {
     	die("Error");
     }
     else{
     	while ($data = mysqli_fetch_assoc($resultado)){
     		$arreglo["data"][]=$data;
     	}
     	echo json_encode($arreglo);
     }
	
?>