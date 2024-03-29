<?php echo"<?xml version=\"1.0\" encoding=\"UTF-8\"?>" ?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Login.php</title>
		<style type="text/css">
		
		</style>
	</head>
	<!-- dobbiamo connetterci al dbs (realizzeremo uno script apposito in modo da evitare di riscriverlo ogni volta, al quale accederemo con la funzione php
		require_once(connectiondbs.php);
		successivamente dobbiamo estrarre dal dbs le tabelle 
		1)username
		2)password
		e salvarle in due variabili $arr_username $arr_pwd.
		Fatto questo controlliamo se i dati username e password ricevuti con post sono contenuti nel dbs;
		in caso positivo saremo reindirizzati attraverso la funzione header() in una pagina dedicata agli acquisti;
		in caso negativo torneremo alla pagina di login e verrà mostrato un messaggio di errore login -->
		
	<body>
		<?php	
		/*controlliamo se la connessione è avvenuta correttamente
			if(!$connection)
				printf("Connessione non riuscita");
			else
				printf("Connessione riuscita");
		*/
		if(isset($_POST['login'])){ /*SE PROVENIAMO DA UNA FORM*/
		$dbs_name="movie";
		$username=$_POST['username'];
		$password=$_POST['password'];
		try{ /*tentiamo la connessione al dbs richiede gestione eccezioni*/
			$connection= new mysqli("localhost","root","",$dbs_name); /*accediamo al dbms con usrn=root e pwd non settata*/
			$sql= "SELECT * FROM utente WHERE username='$username' AND password='$password'"; /*realizziamo la query che controlla se i dati ricevuti via POST sono nel dbs*/
			$queryresult= mysqli_query($connection,$sql); /*mandiamo la query al dbs*/
			if($queryresult){ /*se la query da un risultato valido allora verifichiamo che l'utente esista*/
				$row = mysqli_fetch_array($queryresult); /*salviamo l'utente e le sue informazioni in un array*/
				if($row){ /*in questo caso l'utente esiste allora avviamo una sessione e salviamo la spesa totale*/
					printf("Login effettuato<br />");
					session_start();
					$_SESSION['totalespeso']=$row['totalespeso'];/*salviamo in una sessione i dati ciò implica l'invio di un cookie al web browser che ci sarà reinviato ogni qual volta esso richiederà questa pagina*/
					$_SESSION['datalogin']=time();
					$_SESSION['username']=$username;
					$_SESSION['password']=$password;
					/*a questo punto dovremo essere reindirizzati in una pagina dove poter effettuare acquisti*/
					header('Location: telefoni.php'); /*header indirizza a quella pagina*/
					/*echo"Benvenuto ";echo $row['username'];echo "<br />Totale speso=";echo $row['totalespeso'];echo"$"; /*stampiamo messaggio di benvenuto all'utente
					echo"<br />Orario collegamento:";echo $_SESSION['datalogin'];*/
					exit(); /*chiudiamo la sessione*/
				}
				else {/*l'utente non esiste*/
					/*header('Location: inizio.html');*/
					echo"<h1> ACCESSO NEGATO </h1><hr>";
				}
			}
			else { /*se non siamo riusciti ad accedere alla tabella*/
				printf("Ops... la query non da risultato!");
				exit();
				$connection->close(); /*chiudiamo connessione con dbs*/
			}
		}
		catch(Exception $e){/*se non siamo riusciti a connetterci al dbs*/
			echo "<h1 style=\"color:red;\">Impossibile raggiungere il server (Fatal error)</h1><hr>";
			exit();
			$connection->close(); /*chiudiamo connessione con dbs*/
		}
		}
		else{ /*SE NON PROVENIAMO DA UNA FORM*/
			echo "<h1>Tentativo di accesso illegale</h1><hr>";
		}
		?>
	
	
	</body>



</html>