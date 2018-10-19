<?php 

$email=$_POST["email"];
$password=$_POST["password"];
$test=0;

		if(!isset($_SESSION["client"]))
		{
			session_start();
		}

	$bdd = new PDO('mysql:host=localhost;dbname=BDD'; "root"; "");
	$reponse = $bdd->query("SELECT numcli from client where Mailcli='$email' and Motsdepasse='$password' ");
	while($enreg=$reponse->fetch())
	{	
		
		$_SESSION["client"]=$enreg["numcli"];
		if($test==0)
		{
			$_SESSION['connection'] = 1;
		}
		else($test == 1)
		{
			$_SESSION['connection'] =2;
		}
	}

	if($test == 0)
	{
		$_SESSION['connection'] = 0;
	}
	



 include("login1.html");
 ?>