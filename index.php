<html>
<header>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</header>

<?php
require __DIR__ . '/vendor/autoload.php';

use \Curl\Curl;

$conf = require('conf.php');
$curl = new Curl($conf->admin_url);
$curl->setHeader('X-Requested-With', 'XMLHttpRequest');
$curl->setBasicAuthentication($conf->username, $conf->password);


$curl->post('/clientes/index/',[
    'sidx' => '1', // obrigatório informar pois caso contrário a pesquisa por id retorna um header location
     'servico_internet' =>  '0', // retorna somente os resultados com serviço de Internet ou telefone ativo
    'id' => '', // id do cliente,
    'tipo_servico' => 'TELEFONIA',
    'revendas_id' => -1,
    //'vendedor_id' => 0,
    'pontos_autenticacao_pppoe_id' => -1,
    'tipo_vencimento' => 100,
    //  'forma_cobranca' => 'TODOS'
]);

?>

<table class="table table-striped table-light">
    <thead>
        <tr>
            <th scope="col">ID-CONTRATO</th>
            <th scope="col">ID-CLIENTE</th>
            <th scope="col">ID-SERVICO</th>
            <th scope="col">Nome</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>

    <tbody>

        <?php
            $resp = json_encode($curl->response);
            $test = json_decode($resp, true);
            foreach ($test['rows'] as $key => $value){
            $result[] =array($value['cell'][3]=>$value['cell'][1],$value['id']);
          ?>

        <tr>
            <td><?php echo $value['id']; ?></td>
            <td><?php echo $value['cell'][0]; ?></td>
            <td><?php echo $value['cell'][1]; ?></td>
            <td><?php echo $value['cell'][3]; ?></td>


            <?php echo '<td> <form  action ="dados.php" id="formBusca" method="post">
            <input hidden class="nome" type="text" name="nomeCliente" value="'.rtrim($value['cell'][3]).'"  />
            <input hidden type="text" name="idCliente" value="'.rtrim($value['cell'][0]).'"  />
            <input hidden type="text" name="nomeCliente" value="'.rtrim($value['cell'][3]).'"  />
            <button name ="ID" value="'.rtrim($value['cell'][1]).'" type="submit" class="btn btn-primary"><i class="fas fa-angle-double-right"></i>Adicionar Serviço</button>        </form>
            </td>'
            ?>
        </tr>
        <?php
    
        }
        ?>

    </tbody>

</table>



</html>