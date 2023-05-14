<?php  
$dbhost = "localhost";
    $dbuser = "kosierap_z18";
    $dbpassword = "Laboratorium123";
    $dbname = "kosierap_z18";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    $rezultat = mysqli_query($polaczenie, "SELECT google_map_link FROM cms");
    while ($wiersz = mysqli_fetch_array($rezultat)) {

    echo $wiersz[0];
    }
    mysqli_close($polaczenie);
?>