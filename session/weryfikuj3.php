<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
  <HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
  </HEAD>
<BODY>
<?php
$login = htmlentities ($_POST['login'], ENT_QUOTES, "UTF-8"); 
$password = htmlentities ($_POST['password'], ENT_QUOTES, "UTF-8");
$link = mysqli_connect(localhost, kosierap_z18, Laboratorium123, kosierap_z18);
if(!$link) { echo"Error: ". mysqli_connect_errno()." ".mysqli_connect_error(); }
mysqli_query($link, "SET NAMES 'utf8'");
$result = mysqli_query($link, "SELECT * FROM admins WHERE (username='$login')");
$rekord = mysqli_fetch_array($result); 
if(!$rekord) {
$ipaddress = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents ("http://ip-api.com/json/{$ip}"); $details = json_decode ($json);
return $details;
}
//KONTYNUACJA Z LABORATORIUM 1
mysqli_close($link);
echo "Nie ma takiego użytkownika!";
 }
else {
  $klucz_apcu = "{$_SERVER['SERVER_NAME']}~login:{$_SERVER['REMOTE_ADDR']}"; //Tworzenie klucza APCu
  $i = (int)apcu_fetch($klucz_apcu); //Licznik do klucza APCu
  if ($i >= 2) { //Jezeli bedzie wiecej niz 2 proba logowania
    echo "Przekroczono liczbę prób logowania dla twojego IP({$_SERVER['REMOTE_ADDR']}) - zablokowany dostęp przez minutę"; //Prosty komunikat
    exit();
  }
  if($rekord['password']==$password){ //Jezeli haslo jest prawidlowe
    if($rekord[5]==1) {
      header('Refresh: 2; URL=logout.php');
      print "<h1>Konto jest zablokowane</h1>";}
    else{
    
    session_start(); //Rozpoczecie sesji
    $_SESSION ['login'] = $login;
	$_SESSION ['loggedin'] = true;
    $log = mysqli_query($link, "INSERT INTO login_history (username, ip_address) VALUES ('$login','".$_SERVER["REMOTE_ADDR"]."');") or die ("DB error: $dbname");
	echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}";
  	apcu_delete($klucz_apcu); //Usuwa klucz APCu przez co bedzie mozliwe ponowne logowanie
    header('Location: forum.php'); //Przejdz dalej do index4.php
    }
 }
  else{
    echo "Błędne hasło";
    
   	apcu_inc($klucz_apcu, 1, $fail, 60); //Dodaj do licznika przez 60s
    mysqli_close($link);    
  }
 }
?> </BODY> </html>
