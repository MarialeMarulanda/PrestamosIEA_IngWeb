<?php


extract($_POST);
	require("conexion.php");
	$sentencia="update login set user='$user', password='$pass', email='$email', pasadmin='$pasadmin' where id='$id'";
	$resent=mysqli_query($mysqli,$sentencia);
	if ($resent==null) {
		echo "Error de procesamieno no se han actuaizado los datos";
		echo '<script>alert("ERROR EN PROCESAMIENTO NO SE ACTUALIZARON LOS DATOS")</script> ';
		header("location: admin.php");
		
		echo "<script>location.href='admin.php'</script>";
	}else {
		echo '<script>alert("REGISTRO ACTUALIZADO")</script> ';
		
		echo "<script>location.href='registros.php'</script>";

		
	}
?>