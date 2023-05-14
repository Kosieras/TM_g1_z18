<?php 
//Spradzanie sesji
declare(strict_types=1);
session_start();
if (!isset($_SESSION['loggedin'])) //Jezeli nie ma sesji
{
  $_SESSION['login'] = "GOSC";
}
  $connection = mysqli_connect('localhost', 'kosierap_z18', 'Laboratorium123', 'kosierap_z18');
  	if (!$connection){
		echo " MySQL Connection error." . PHP_EOL;
		echo "Errno: " . mysqli_connect_errno() . PHP_EOL; echo "Error: " . mysqli_connect_error() . PHP_EOL; exit;
	}
        $findUser = mysqli_query($connection, "Select * from admins") or die ("DB error 2: $dbname");
 while ($row = mysqli_fetch_array ($findUser)) if($row[1] == $_SESSION['login'])  {
if($row[5]==1){
  print "<h1>NASTĄPIŁA BLOKADA KONTA, WYLOGOWUJE</h1>";
  header('Refresh: 2; URL=logout.php');
}
   $_SESSION['userup'] = $row[3];
    $_SESSION['userid'] = $row[0];
   
 }

  ?>
<!-- Prosty CSS -->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<style>
table {
	float: left;
	background-color: rgba(218, 238, 242, 1);
	max-width: 50%;
}

.log,
.topics {}

input[type=submit] {
	background-color: white;
	color: black;
	border: 2px solid #555555;
}

input[type=submit]:hover {
	background-color: #555555;
	color: white;
}

button,
.labelUrl {
	background-color: white;
	color: black;
	border: 2px solid #555555;
}

.divUrl {
	padding-left: 10px;
}

button:hover {
	background-color: #555555;
	color: white;
}

.left {
	width: 300px;
}

.right {
	width: 1000px;
	height: 800px;
}

.imgDel,
.imgBlk,
img>.right,
.addimg {
	max-width: 25px;
}

.resMess {
	border-bottom: 5px solid red;
}

.profileH {
	border-top: 5px solid blue;
}

.lgout {
	border-bottom: 5px solid blue;
}

h2 {
	color: red;
}

.logi {
	color: red;
}

.napisTR {
	position: relative;
	background-color: rgba(218, 238, 242, 1);
	width: 50%;
	height: 180px;
}

.napis {
	mask-image: url("icons/napis_anim.svg");
	border: 2px dashed #555555;
	animation-name: example;
	animation-duration: 2s;
	animation-direction: alternate-reverse;
	animation-iteration-count: infinite;
	height: 180px;
}

.anim>#evBT7qIalKO1 {
	filter: invert(20%) sepia(97%) saturate(4013%) hue-rotate(353deg) brightness(93%) contrast(127%);
	height: 500px;
	left: 0;
}

@keyframes example {
	to {
		filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%);
	}
}
</style>
<script>
//Funkcje JS na wyswietlanie odpowiednich elementow
var addTopic = document.getElementById("addTopic");
var log = document.getElementById("log");
var addMess = document.getElementById("addMessage");
var showMTO = document.getElementById("showMTO");
var showAddM = document.getElementById("showAddM");

function addTopicFunction() {
	var lorem = document.getElementById("lorem");
	var txt = document.getElementById("txt");
	var messageName = document.getElementById("messageName");
	var showBM = document.getElementById("showBM");
	if(txt.style.display === "block") {
		txt.style.display = "none";
	} else {
		txt.style.display = "block";
	}
}

function showMessagesToMe() {
	var lorem = document.getElementById("lorem");
	var txt = document.getElementById("txt");
	var showBM = document.getElementById("showBM");
	var myMessages = document.getElementById("myMessages");
	if(myMessages.style.display === "block") {
		txt.style.display = "none";
		myMessages.style.display = "none";
		showBM.style.display = "none";
		lorem.style.display = "block";
	} else {
		txt.style.display = "block";
		myMessages.style.display = "block";
		showBM.style.display = "none";
		lorem.style.display = "none";
	}
}

function showMessage() {
	var messOpt = document.getElementById("messOpt");
	if(messOpt.style.display === "block") {
		messOpt.style.display = "none";
	} else {
		messOpt.style.display = "block";
	}
}
</script>
<!DOCTYPE html>

<head>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382989326788510" crossorigin="anonymous"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js">
	</script>
</head>

<BODY>
	<!--Stworzenie tabeli -->
	<table CELLPADDING=5 BORDER=1>
		<tr>
			<div class="napisTR"> <?php
      
        $resultMessages = mysqli_query($connection, "Select logo_file from cms") or die (mysqli_error($connection));
	while ($row = mysqli_fetch_array ($resultMessages)){
      $value = $row[0];
      print "<center>";
      if(end(explode(".",$value)) =="png" || end(explode(".",$value)) =="jpg" || end(explode(".",$value)) =="jpeg" || end(explode(".",$value)) =="gif") print "<img style='max-height:180px' class='imgLogo' src='../logo_file/$value'/>";
    else if(end(explode(".",$value)) =="svg") print " <div class='napis' id='napis'>
      <object style='height:180px' class='anim' type='image/svg+xml' data='../logo_file/$value'>
      </object>

    </div>";
     
print "</center>";
        }
    if($_SESSION['login']!="GOSC")  print "
      <div class='divUrl'>
       <form name='formAdd' class='formAdd' id='formAdd' method='POST' action='upload.php' enctype='multipart/form-data'>
   <label class='labelUrl' for='fileToUpload'>
     Edit URL
    	<input type='file' name='fileToUpload' id='fileToUpload' style='display: none;'>
  	</label>
	</form>
      </div>
      ";
        
        ?> <div>
				</div>
			</div>
		</tr>
		<tr>
			<!--Lewa strona z tematami i logowaniem -->
			<td id="left" class="left">
				<br>
				<h3><a href='forum.php?cms=about_company'>O firmie</a></h3>
				<h3><a href='forum.php?cms=contact'>Kontakt</a></h3>
				<h3><a href='forum.php?googleMaps=googleMaps'>Jak do nas dotrzeć</a></h3>
				<h3><a href='forum.php?cms=offer'>Oferta</a></h3>
				<h3><a href='forum.php?chatbot=chatbot'>Chatbot</a></h3> <?php if($_SESSION['login']!="GOSC") print"  <h3><a href='forum.php?chatbotHistory=history'>Historia Chatbota</a></h3> ";?> <br> <?php
     if($_SESSION['login']!="GOSC") {
      print "Zalogowano jako: <a id='logi' class='logi'>".$_SESSION['login']."</a>";
       
    	 print "<div id='lgout' class='lgout'><form action='logout.php'><br> <input type='submit' value='LOGOUT'/></form></div>";
      
       
    }
    else{
      print "<form method='post' action='weryfikuj3.php'>
Login:<input type='text' name='login' maxlength='20' size='20'><br> Hasło:<input type='password' name='password' maxlength='20' size='20'><br> <input type='submit' value='Send'/>
</form>";
   
    }
    ?>
			</td>
			<!--Prawa tabela-->
			<td id="right" class="right" rowspan="2">
				<!--LOGI O LOGOWANIU -->
				<!--WYSWIETLANIE LEKCJI -->
				<div id="lekcja" class="lekcja" name="lekcja"> <?php
        $cms = $_GET['cms'];
        if(isset($_GET['cms'])){
        $resultMessages = mysqli_query($connection, "Select ".$cms." from cms") or die (mysqli_error($connection));
	while ($row = mysqli_fetch_array ($resultMessages)){
     
    if($_SESSION['login']!="GOSC")  print "<form method='POST' action='forum.php?editLekcja=$cms' enctype='multipart/form-data'><input type='submit' id='editLekcja' name='editLekcja' class='editLekcja' value='Edit'/></form>";
      print "<br>";
      print $row[0];
            print "<br>";

        }
        }
        ?> </div>
				<div id="chatbot" class="chatbot" name="chatbot"> <?php
        $chatbot = $_GET['chatbot'];
        if(isset($_GET['chatbot'])){

      print "
      
             <iframe src='asystent.php' width='1000' height='850' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>

      
      
      ";
          
        }
        if(isset($_GET['chatbotHistory'])){
            
               print "<div style='overflow-y: scroll; height:700px;'>";
                $resultMessages = mysqli_query($connection, "Select * from chatbot") or die (mysqli_error($connection));
	while ($row = mysqli_fetch_array ($resultMessages)){
      print "<hr style='height: 5px;
           background: teal;
           margin: 20px 0;
           box-shadow: 0px 0px 4px 2px rgba(204,204,204,1);'><br>";
     print "Użytkownik o IP: ".$row[4]." o godzinie: ".$row[2]." zadał pytanie: ".$row[3];
        print "<br>";
      print "Uzyskał odpowiedź: ";
       print "<br><hr>";
      print html_entity_decode($row[5], ENT_COMPAT, 'UTF-8');
           

    }
              print "</div>";
        }
         
             
        ?> </div>
				<!-- EDIT LEKCJA -->
				<div id="editLekcje" class="editLekcje" name="editLekcje"> <?php
        if(isset($_GET['editLekcja'])){
        $resultMessages = mysqli_query($connection, "Select  ".$_GET['editLekcja']." from cms") or die (mysqli_error($connection));
	while ($row = mysqli_fetch_array ($resultMessages)){
     print "<form method='POST' action='forum.php?editContent=".$_GET['editLekcja']."' enctype='multipart/form-data'>
     	            <textarea class='editor2' name='editor2' id='editor2' rows='10' cols='80'>
                $row[0]
            </textarea>
     <input type='submit' name='addLekcjaEdit' id='addLekcjaEdit' class='addLekcjaEdit' value='Edit'/></form>
     <script>     
    ClassicEditor
        .create( document.querySelector( '.editor2' ) )
        .catch( error => {
            console.error( error );
        } );</script> 
     ";
    
    }}?> </div>
				<div id="googleMaps" class="googleMaps" name="googleMaps"> <?php
        if(isset($_GET['googleMaps']) ){
       print "
       <iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3974.035413887511!2d18.13081319502851!3d53.142590346872225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470313b103a9ea1d%3A0x2a29c87a5d2749d5!2sPolitechnika%20Bydgoska%20im.%20Jana%20i%20J%C4%99drzeja%20%C5%9Aniadeckich!5e0!3m2!1spl!2spl!4v1684060933680!5m2!1spl!2spl' width='1000' height='850' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>
       
       ";
    
    }?> </div>
				<!-- TESTY --> <?php
  $addLekcja = $_POST[ 'addLekcja' ];

  //EDYCJA LEKCJI
    $addLekcja = $_POST[ 'addLekcjaEdit' ];
//Dodaj lekcje
 if(isset($addLekcja)){
$editor = $_POST[ 'editor2' ];
		//$test = "update cms set ".$_GET['editContent']." = ".$_POST[ 'editor2' ]."";
   //print $test;
  		$resultTopic = mysqli_query($connection, "update cms set ".$_GET['editContent']." = '".$_POST[ 'editor2' ]."'") or die (mysqli_error($connection));
  		header('Refresh: 2; URL=forum?cms='.$_GET['editContent'].'.php');
 
	}



  ?> <script>
				document.getElementById("fileToUpload").onchange = function() {
					document.getElementById("formAdd").submit();
				};
				</script>
</BODY>

</HTML>