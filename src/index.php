<?php
require __DIR__ . '/vendor/autoload.php';

$redis_server=getenv("REDIS_SERVER") or die ("variavel REDIS_SERVER nao foi definida");

$redis = new Predis\Client(array(
		"scheme" => "tcp",
		"host" => $redis_server,
		"port" => 6379
	));

// Gravar mensagem no Redis
if ($_POST["submit"] == "Submit") {
	$redis->lpush("mural-list", $_POST["texto"]);
}

// Exibir Mural
?>
<html>
<form action="" method="POST">
	<input type="text" name="texto" /> 
	<br><br>
	<input type="submit" name="submit" value="Submit">
</form>

<h1>Mensagens</h1>

<?php
$msgs = $redis->lrange("mural-list", 0 ,1000);

foreach ($msgs as $msg)
	echo "$msg <br><hr>";

?>
</html>
