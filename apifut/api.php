<?php
    $comando = $_GET['Comando'];

    if($comando == ''){
        echo 'Comando invalido!';
        exit();
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://jsuol.com.br/c/monaco/utils/gestor/commons.js?&file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/2022/30/dados.json',
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
 
    $array_api_fut = json_decode($response, true);

    $pos = 0;
    $f = 0;
    if($comando == 'Classificacao'){
        $array_classificacao = $array_api_fut['fases']['3453']['classificacao']['grupo']['Único'];
        $array_equipes = $array_api_fut['equipes'];
        $array_pontos = $array_api_fut['fases']['3453']['classificacao']['equipe'];
        
       // $array_id_jogos = $array_api_fut['fases']['3453']['jogos']["rodada"][$id_rodada];
       //

        foreach($array_classificacao as $value){ // id dos times ja tem no value
            $array_classificacao_final[$pos]['Nome'] = $array_equipes[$value]['nome-comum'];
            $array_classificacao_final[$pos]['Brasao'] = $array_equipes[$value]['brasao'];
            $array_classificacao_final[$pos]['pg'] = $array_pontos[$value]['pg']['total'];
            $array_classificacao_final[$pos]['j'] = $array_pontos[$value]['j']['total'];
            $array_classificacao_final[$pos]['v'] = $array_pontos[$value]['v']['total'];
            $array_classificacao_final[$pos]['e'] = $array_pontos[$value]['e']['total'];
            $array_classificacao_final[$pos]['d'] = $array_pontos[$value]['d']['total'];
            $array_classificacao_final[$pos]['gp'] = $array_pontos[$value]['gp']['total'];
            $array_classificacao_final[$pos]['gc'] = $array_pontos[$value]['gc']['total'];
            $array_classificacao_final[$pos]['sg'] = $array_pontos[$value]['sg']['total'];
            
            //dando erro array deslocada valor nulo
            $rodadaAtual = $array_api_fut['fases']['3453']['rodada']['atual'];
            $numRodadas = ($rodadaAtual - 4);

            for($i = $rodadaAtual; $i >= $numRodadas; $i--){
                $array_jogos = $array_api_fut['fases']['3453']['jogos']['rodada'][$i];
                foreach($array_jogos as $valor){
                    $timeUm = $array_api_fut['fases']['3453']['jogos']["id"][$valor]["time1"];
                    $timeDois = $array_api_fut['fases']['3453']['jogos']["id"][$valor]["time2"];
                    (int)$placarUm = $array_api_fut['fases']['3453']['jogos']["id"][$valor]["placar1"];
                    (int)$placarDois = $array_api_fut['fases']['3453']['jogos']["id"][$valor]["placar2"];

                    if($timeUm == $value){
                        $vitoria = ($placarUm > $placarDois);
                        $derrota = ($placarUm < $placarDois);
                        $empate = ($placarUm == $placarDois);
                    
                        if($vitoria === true){
                            $array_classificacao_final[$pos]['Jogos'][] = 'Vitoria';
                        }elseif($derrota === true){
                            $array_classificacao_final[$pos]['Jogos'][] = 'Derrota';
                        }elseif($empate === true){
                            $array_classificacao_final[$pos]['Jogos'][] = 'Empate';
                        }
                    }elseif($timeDois == $value){
                        $vitoria = ($placarUm < $placarDois);
                        $derrota = ($placarUm > $placarDois);
                        $empate = ($placarUm == $placarDois);

                        if($vitoria === true){
                            $array_classificacao_final[$pos]['Jogos'][] = 'Vitoria';
                        }elseif($derrota === true){
                            $array_classificacao_final[$pos]['Jogos'][] = 'Derrota';
                        }elseif($empate === true){
                            $array_classificacao_final[$pos]['Jogos'][] = 'Empate';
                        }
                    }
                }
                
            }
            $pos++;
        }

        $json_classificacao = json_encode($array_classificacao_final);

        echo $json_classificacao;


    }else if($comando == 'Rodada'){
        $id_rodada = $_GET['Rodada'];
        $array_id_jogos = $array_api_fut['fases']['3453']['jogos']["rodada"][$id_rodada];
        $array_jogos = $array_api_fut['fases']['3453']['jogos']['id'];
        $pos = 0;
 
        foreach($array_id_jogos as $value){
            $array_rodada[$pos]['Data'] = $array_jogos[$value]['data'];
            $array_rodada[$pos]['Horario'] = $array_jogos[$value]['horario'];
            $array_rodada[$pos]['Time1'] = $array_jogos[$value]['time1'];
            $array_rodada[$pos]['Time2'] = $array_jogos[$value]['time2'];
            $array_rodada[$pos]['Placar1'] = $array_jogos[$value]['placar1'];
            $array_rodada[$pos]['Placar2'] = $array_jogos[$value]['placar2'];
            $array_rodada[$pos]['Estadio'] = $array_jogos[$value]['estadio'];
            $array_rodada[$pos++]['URL'] = $array_jogos[$value]['url-posjogo'];
        }
        $json_rodada = json_encode($array_rodada);
        echo $json_rodada;
    }else if($comando == 'Equipes'){
        $array_equipes = $array_api_fut['equipes'];
        $json_equipes = json_encode($array_equipes);

        echo $json_equipes;
    }else if($comando == 'Equipe'){
        $id_equipe = $_GET['Equipe'];

        $array_equipe = $array_api_fut['equipes'][$id_equipe];
        $json_equipe = json_encode($array_equipe);

        echo $json_equipe;
    }else{
        echo 'Comando invalido';
    }

?>