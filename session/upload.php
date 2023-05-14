<?php
//Pobranie zmiennych
session_start();
$user = $_SESSION["login"];
$topic = $_SESSION["topic"];
$userid = $_SESSION["userid"];
mkdir("../logo_file", 0755, true);
$target_file = "../logo_file/". basename($_FILES["fileToUpload"]["name"]); 
  $connection = mysqli_connect('localhost', 'kosierap_z18', 'Laboratorium123', 'kosierap_z18');
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Error: " . mysqli_connect_errno() . PHP_EOL; echo "Error: " . mysqli_connect_error() . PHP_EOL; exit;
}
else {
  
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){ 
 $result = mysqli_query($connection, "update cms set logo_file = '$target_file';") or die ("DB error 2:  $connection->error);");
   echo "Uploading...\n";

  header('Refresh: 2; URL=forum.php');
} 
else {
  
  print $topic." -> ".$userid." -> ".$target_file." -> ".$user."\n";
  echo "Error uploading file.";
}
}
?>
