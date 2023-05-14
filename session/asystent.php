<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Asystent</title>
	<link rel="stylesheet" href="assistant.css">
	<style>
	#avatar {
		max-height: 200px;
	}

	.anim {
		max-width: 50px;
	}

	body {
		background-color: white;
	}
	</style>
</head>

<body>
	<div id="content">
		<h1>ASYSTENT</h1>
		<div id="divAv">
			<img id="avatar" src="svg/student1b.svg" />
		</div>
		<h3 id="info"> </h3>
		<h4 id="newInfo"> </h4>
		<script>
		const joke = ["Nie ma co się rozwodzić nad tym, co już minęło.", "Jak mówi stare przysłowie: lepiej zapobiegać niż leczyć.", "Nie sposób niczego powiedzieć na ten temat.", "Takie są uroki życia, trzeba po prostu zaakceptować.", "Każdy ma swoje problemy i trudności do przezwyciężenia.", "Mądrość ludowa mówi, że czas leczy rany.", "Nie warto się nad tym zastanawiać, lepiej iść do przodu.", "Jak mówi przysłowie: lepiej dmuchać na zimne.", "Niech czas pokaże, co przyniesie przyszłość.", "Nie ma co lamentować nad tym, co nie da się zmienić.", ];
		var i = 0;

		function typeWriter() {
			var text = "Spróbuj mnie o coś zapytać 'hej/witam', 'h/?', ...";
			var obrazek = document.getElementById("avatar");
			obrazek.src = "svg/student3.svg";
			setTimeout(function() {
				obrazek.src = "svg/student1b.svg";
			}, 1500);
			if(i < text.length) {
				document.getElementById("info").innerHTML += text.charAt(i);
				i++;
				setTimeout(typeWriter, 10);
			}
		}
		typeWriter();
		</script>
		<input type="text" id="txt" />
		<button type="button" id="startBtn" onclick="check();">Zapytaj</button>
		<div id="result"></div>
		<div id="result2"></div>
		<p id="processing"></p>
	</div>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script>
	// Store voices
	// UI elements
	const startBtn = document.getElementById("startBtn");
	const result = document.getElementById("result");
	const result2 = document.getElementById("result2");
	const processing = document.getElementById("processing");
	const rawText = "hello";

	function check() {
		//const text = document.getElementById("txt");
		let text = document.getElementById("txt").value.toLowerCase();
		let response = null;
		var ajax = null;
		if(text.includes("czesc") || text.includes("dzień dobry") || text.includes("siema") || text.includes("witam") || text.includes("witaj") || text.includes("cześć") || text.includes("dzień dobry") || text.includes("hej")) {
			document.getElementById("newInfo").innerHTML = "";
			var i = 0;
			var text2 = "Witaj Szanowny Kliencie, jak mogę Ci pomóc?";

			function typeWriter2() {
				var obrazek = document.getElementById("avatar");
				obrazek.src = "svg/student3.svg";
				setTimeout(function() {
					obrazek.src = "svg/student1b.svg";
				}, 1500);
				if(i < text2.length) {
					document.getElementById("newInfo").innerHTML += text2.charAt(i);
					i++;
					setTimeout(typeWriter2, 10);
				}
			}
			typeWriter2();
			$.post("saveChat.php", {
				text: text,
				chatbot: text2
			});
		} else if(text == "?" || text == "h") {
			document.getElementById("newInfo").innerHTML = "";
			var i = 0;
			var text2 = "Mogę odpowiedzieć na parę pytań jak: Jaki jest kontakt/adres/telefon; Jak do was dotrzeć; Podaj ofertę;";

			function typeWriter2() {
				var obrazek = document.getElementById("avatar");
				obrazek.src = "svg/student3.svg";
				setTimeout(function() {
					obrazek.src = "svg/student1b.svg";
				}, 1500);
				if(i < text2.length) {
					document.getElementById("newInfo").innerHTML += text2.charAt(i);
					i++;
					setTimeout(typeWriter2, 10);
				}
			}
			typeWriter2();
			$.post("saveChat.php", {
				text: text,
				chatbot: text2
			});
		} else if(text.includes("kontakt") || text.includes("adres") || text.includes("telefon") || text.includes("skontaktować") || text.includes("telefonu") || text.includes("miejsce") || text.includes("Telefonu") || text.includes("Miejsce") || text.includes("Kontakt") || text.includes("Adres") || text.includes("Telefon") || text.includes("Skontaktować")) {
			document.getElementById("newInfo").innerHTML = "";
			var i = 0;

			function typeWriter2() {
				var text2 = "Oto nasze informacje kontaktowe!";
				var obrazek = document.getElementById("avatar");
				obrazek.src = "svg/student3.svg";
				setTimeout(function() {
					obrazek.src = "svg/student1b.svg";
				}, 1500);
				if(i < text2.length) {
					document.getElementById("newInfo").innerHTML += text2.charAt(i);
					i++;
					setTimeout(typeWriter2, 10);
				}
			}
			typeWriter2();
			$(document).ready(function() {
				$.ajax({
					url: "contact.php",
					type: "GET",
					dataType: "html",
					success: function(response) {
						$("#result2").html(response);
						$.post("saveChat.php", {
							text: text,
							chatbot: response
						});
					}
				});
			});
		} else if(text.includes("nawigacja") || text.includes("jak dotrzeć") || text.includes("Jak dotrzeć") || text.includes("jak dotrzec") || text.includes("jak dotrzec") || text.includes("nawigację") || text.includes("jak do was dotrzec") || text.includes("jak do was dotrzeć") || text.includes("dotrzec") || text.includes("dotrzeć")) {
			document.getElementById("newInfo").innerHTML = "";
			var i = 0;

			function typeWriter2() {
				var text2 = "Oto tak możesz do nas dojechać!";
				var obrazek = document.getElementById("avatar");
				obrazek.src = "svg/student3.svg";
				setTimeout(function() {
					obrazek.src = "svg/student1b.svg";
				}, 1500);
				if(i < text2.length) {
					document.getElementById("newInfo").innerHTML += text2.charAt(i);
					i++;
					setTimeout(typeWriter2, 10);
				}
			}
			typeWriter2();
			$(document).ready(function() {
				$.ajax({
					url: "map.php",
					type: "GET",
					dataType: "html",
					success: function(response) {
						$("#result2").html(response);
						$.post("saveChat.php", {
							text: text,
							chatbot: response
						});
					}
				});
			});
		} else if(text.includes("godzina") || text.includes("czas")) {
			response = new Date().toLocaleTimeString();
		} else if(text.includes("oferta") || text.includes("ofertę") || text.includes("ofertą") || text.includes("Ofertę") || text.includes("Oferta") || text.includes("Ofertą") || text.includes("Oferte") || text.includes("oferte")) {
			document.getElementById("newInfo").innerHTML = "";
			var i = 0;

			function typeWriter2() {
				var text2 = "Oto nasza oferta!";
				var obrazek = document.getElementById("avatar");
				obrazek.src = "svg/student3.svg";
				setTimeout(function() {
					obrazek.src = "svg/student1b.svg";
				}, 1500);
				if(i < text2.length) {
					document.getElementById("newInfo").innerHTML += text2.charAt(i);
					i++;
					setTimeout(typeWriter2, 10);
				}
			}
			typeWriter2();
			$(document).ready(function() {
				$.ajax({
					url: "offer.php",
					type: "GET",
					dataType: "html",
					success: function(response) {
						$("#result2").html(response);
						$.post("saveChat.php", {
							text: text,
							chatbot: response
						});
					}
				});
			});
		} else {
			response = "<h3>Jestem tylko początkującym botem i nie znam odpowiedzi na to pytanie, lecz w ramach rekomensaty proszę przeczytać te sfromułowanie: <br><a style='color:red'>" + getRandomItemFromArray(joke) + "</a>";
			$.post("saveChat.php", {
				text: text
			});
		}
		result.innerHTML = response;
	}

	function getRandomItemFromArray(array) {
		const randomItem = array[Math.floor(Math.random() * array.length)];
		return randomItem;
	};
	</script>
</body>

</html>