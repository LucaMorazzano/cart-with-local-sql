<?php echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>" ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Checkout</title>
		<style type="text/css">
			body{
				background-color:beige;
				text-align:center;
				font-family:Arial;
			}
			#header{
				background-color:blue;
				color:white;
				border-style:solid;
				border-color:black;
				display:flex;
				justify-content:center;
			}
			#main{
				display:flex;
				justify-content:center;
				padding:2%;
				font-size:30px;
			}
			.borderrow{
				background-color:blue;
				color:white;
			}
		</style>
	</head>
	<!-- nella pagina di checkout dovremo come prima cosa richiamare l'array di sessione contenente le informazioni sui prodotti selezionati
	successivamente richiamare l'array relativo alla spesa totale ed aggiornare nel dbs la spesa dell'utente-->
	<body>
	<div id="header">
		<h1>CHECKOUT ZONE</h1>
	</div>
	<div id="main">
		<?php
			/*come prima cosa avviamo la sessione*/
			session_start();
			/*dopo stampiamo a schermo le info contenute negli array di sessione relativi al carrello*/
			if($_SESSION['carrello'] && $_SESSION['spesa_attuale']){
				echo "<table border=\"1\">
						<tr class=\"borderrow\">
						<td><h3>Carrello</h3></td>
						</tr>";
				foreach($_SESSION['carrello'] as $item){ /*METODO STAMPA ELEMENTI ARRAY*/
					echo "<tr>
						<td>$item</td>
						</tr>";
				}
				echo "<tr class=\"borderrow\">
						<td> TOTALE ";echo $_SESSION['spesa_attuale'];echo"$ </td></tr></table>";
			}
			else{ /*se il carrello è vuoto stampiamo un annuncio*/
				echo "<h1 style=\"color:red\"> CARRELLO VUOTO <hr> </h1>";
			}
			echo "</div>"; /*fine div main content*/
			echo "<form action=\"telefoni.php\" method=\"post\">
					<p><input type=\"submit\" name=\"return\" value=\"Torna al negozio\"></p></form>"; /*form per dare l'opportunità all'utente di tornare in ogni caso al negozio per fare modifiche*/
			echo "<form action=\"Arrivederci.php\" method=\"post\"><p><input type=\"submit\" name=\"paga\" value=\"Effettua pagamento\"></p>";/*form per pagare e terminare*/
			exit(); /*chiudiamo la sessione*/
		?>
	</body>


</html>