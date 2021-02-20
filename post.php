<html>
<header>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</header>
<?php 
require __DIR__ . '/vendor/autoload.php';
include 'dados.php';
use \Curl\Curl;


$value1 = trim($_POST["telefone"]);
$value2 = trim($_POST["id"]);
$value3 = trim($_POST["idCliente"]);

$dados = array('id' =>$value3 ,
               'clientes_id' =>$value3,
               'telefonia_planos_id' => '2',
               'sip_login' => $value1,
               'sip_senha' => '{senha sip pulse}',
               'bancos_id' => '2',
               'telefonia_servidores_troncos_ramais_id'=>$value2

);

$username = '{username}';
$password = '{password}';
$url = "http://{url}/clientes_telefonia/novo/$value3";

$auth = stream_context_create(array(
    "http" => array(
        "header" => "Authorization: Basic " . base64_encode("$username:$password"),
      
    )));




?>

</html>