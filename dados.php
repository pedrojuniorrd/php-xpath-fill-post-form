<html>
<header>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</header>
<?php

$idCliente = $_POST['idCliente'];
$nomeCliente = $_POST['nomeCliente'];
//$array = explode("\n", file_get_contents('clientesfull.txt'));

require __DIR__ . '/vendor/autoload.php';
include 'phpQuery.php';



use \Curl\Curl;
//parametros de login
$username = '{user}';
$password = '{senha}';
$url = "http://{url}/clientes_telefonia/editar/$idCliente";

//header authentication
$auth = stream_context_create(array(
    "http" => array(
        "header" => "Authorization: Basic " . base64_encode("$username:$password"),
      
    )));
//value da option e string da option
$idNode = array();
$valorNode = array();


$contentPage = file_get_contents($url,false,$auth);
$doc = phpQuery::newDocument($contentPage);
phpQuery::selectDocument($doc);

//seleciona pelo ID e TAG do retorno html
foreach (pq('#selTelefoniaServidoresTroncosRamais > option') as $option) {
    //idNode recebe o value da option
    $idNode = ($option->getAttribute('value'));
    //valorNode recebe a string da option
    $valorNode = ($option->nodeValue);
    //array resultante das informações
    $result[] = array('id'=>$idNode,'telefone'=>$valorNode);
}

//html select option, recebe lista válida de números disponíveis
echo "selecione o numero para cadastro <br>";
echo "<br>";
echo '<select  id=numeros name="num">';
echo '<option value="">-----------------</option>';
foreach($result as $key => $value){
echo '<option value=" '.$value['id'].'*'.$value['telefone'].'*'.$idCliente.'*'.$nomeCliente.'">'.$value['telefone'].'</option>'; 
}
echo '</select>';



?>

<script>
$("#numeros").change(function(teste) {

    var NUMBER = $("#numeros").val()
    var split = NUMBER.split("*")
    var num1 = $("#numeros1").html(split[0])
    var num2 = $("#numeros2").html(split[1])
    var num3 = $("#numeros3").html(split[2])
    var nome = $("#nomeCliente").html(split[3])

    var string = num2.text().replace(/[^a-z0-9/\s]/gi, '');
    var string2 = string.replace(/\s/g, '');
    var string3 = num1.text();
    var string4 = num3.text();
    var string5 = nome.text();

    if (confirm("Gostaria de adicionar o número " + string2 + " ao cliente " + string5)) {

        // $.post('teste2.php', { 'id': string3,'telefone':string2,'idCliente':string4}

        // );
    }
});
</script>

<b hidden id="numeros2"></b>
<b hidden id="numeros1"></b>
<b hidden id="numeros3"></b>
<b hidden id="nomeCliente"></b>
<br>

<!-- ==== PREVIEW ===== <br>
 $curl->post('/clientes_telefonia/novo/',[<br>
     'id' =>'' ,<br>
     'clientes_id' =>'' ,<br>
     'telefonia_planos_id' => '2',<br>
     'sip_login' => '<b id="numeros2">'</b>,<br>
     'sip_senha' => '{senha sip pulse}',<br>
     'valor_instalacao' => '0',<br>
     'bancos_id' => '2',<br>
     'telefonia_servidores_troncos_ramais_id' => '<b id="numeros1"></b>'<br> -->




<!--
// echo "<pre>";
// print_r ($result);
// echo "<pre>";

// $conf = require('conf.php');
// $curl = new Curl($conf->admin_url);
// $curl->setHeader('X-Requested-With', 'XMLHttpRequest');
// $curl->setBasicAuthentication($conf->username, $conf->password);

//adicionar cliente
// $curl->post('/clientes_telefonia/novo/',[
//     'id' => $idCliente ,
//     'clientes_id' => $idCliente,
//     // 'telefonia_planos_id' => '2',
//     // 'status' => '1',
//     'sip_login' => '{numero sip pulse}',
//     'sip_senha' => '{senha sip pulse}',
//     // 'isento' => '0',
//     // 'valor_instalacao' => '0',
//     // 'prazo_contrato' => '12',
//     // 'dia_vencimento' => '1',
//      'bancos_id' => '2',
//     // 'data_instalacao' => 'teste',
//     'telefonia_servidores_troncos_ramais_id' => '41'
//     // 'vendedor_id'=>'18'

// ]);
// // var_dump($curl);
// echo 'Response:' . "\n";
// var_dump($curl->response);

//editar cliente
// $curl->post('/clientes_telefonia/editar',[
//     'id' => 166,
//     'sip_login' => '{numero sip pulse}',
//     'sip_senha' => '{senha sip pulse}',
//     'telefonia_servidores_troncos_ramais_id' => '41'
// ]);
// echo 'Response:' . "\n";
// var_dump($curl->response);

// $curl -> get ('/clientes_telefonia/editar/166',[
//     'telefonia_servidores_troncos_ramais_id' => ''

// ]);
// var_dump($curl->response->telefonia_servidores_troncos_ramais_id);




!-->

</html>