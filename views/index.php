<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/style.css"/>

    <title>Campeonato A</title>
</head>

    <?php
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://localhost/apifut/api.php?Comando=Classificacao',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        $array_api = json_decode($response, true);
        
    ?>

<body>

<div class="cabecalho" id="cabecalho">
  Brasileirão série A
</div>

<div class="container">
    <table>
        <tr>
            <td>Clube</td>
            <td></td>
            <td></td>
            <td>Pts</td>
            <td>PJ</td>
            <td>VIT</td>
            <td>E</td>
            <td>DER</td>
            <td>GP</td>
            <td>GC</td>
            <td>SG</td>
            <td>Últimas cinco</td>
        </tr>
        <?php
        $o = 1;
        foreach($array_api as $chave=>$valor){ ?>
        <tr>
            <td><?php echo $o++; ?></td>
            <td><img src="<?php echo $valor['Brasao'];?>"></td>
            <td><?php echo $valor['Nome']; ?></td>
            <td><?php echo $valor['pg']; ?></td>
            <td><?php echo $valor['j']; ?></td>
            <td><?php echo $valor['v']; ?></td>
            <td><?php echo $valor['e']; ?></td>
            <td><?php echo $valor['d']; ?></td>
            <td><?php echo $valor['gp']; ?></td>
            <td><?php echo $valor['gc']; ?></td>
            <td><?php echo $valor['sg']; ?></td>
            <td><?php $ultimasCinco = $valor['Jogos'];
                foreach($ultimasCinco as $value){
                    if($value == "Vitoria"){
                        echo file_get_contents("imagens/certo.svg"); 
                    }elseif($value == "Empate"){
                        echo file_get_contents("imagens/empate.svg"); 
                    }elseif($value == "Derrota"){
                        echo file_get_contents("imagens/errado.svg");
                    }else{
                        echo "Erro ao carregar imagem";
                    }
                }
                ?>
            
            </td>

        </tr>

        <?php }?>
        </table>
    </div>
</body>
</html>