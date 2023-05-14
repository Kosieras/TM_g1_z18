<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
  <HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  </HEAD>
<BODY>
<?php
$text = htmlentities ($_POST['text'], ENT_QUOTES, "UTF-8"); 
$chatbot = $_POST['chatbot'];
$link = mysqli_connect(localhost, kosierap_z18, Laboratorium123, kosierap_z18);
$ipaddress = $_SERVER["REMOTE_ADDR"];
if(!$link) { echo"Error: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
mysqli_query($link);
   if($chatbot!=null) $sql = "INSERT INTO chatbot (id_cms, question, question_ip, answer) VALUES (1, '$text','$ipaddress', '$chatbot');"; 
     else $sql = "INSERT INTO chatbot (id_cms, question, question_ip, answer) VALUES (1, '$text','$ipaddress', 'Jestem tylko początkującym botem i nie znam odpowiedzi na to pytanie');";
    if (mysqli_query($link, $sql)) {
      echo "Utworzono użytkownika.";
	  header('Location: forum.php'); //Przejdz dalej do index4.php
} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($link); //Wyswietl blad z MySQL
}
 
  
?> </BODY> </html>