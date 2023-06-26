<?php
$servername="baimiyu592dx9dbznvfo-mysql.services.clever-cloud.com";
$username="uoejcaaeq0fflvcc";
$password="JlpUogRLy4H0hmTlTjH4";
$database="baimiyu592dx9dbznvfo";
$condb=mysqli_connect($servername, $username, $password,$database);
if(!$condb){
echo "Conexion fallida";    
}
?>