<script src="./js/selecionar_software.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php

    include_once('conexao.php');
    
    // Cria variáveis para armazenar as informações dadas pelo usuário
    $orcamento = $_POST["orcamento"];
    $desempenho = isset($_POST['desempenho']) ? $_POST['desempenho'] : null;
    $software_nome_string = $_POST['txtsoftwares'];
    $array_softwares = explode(",", $software_nome_string);

    // Instanciando variáveis que serão utilizadas ao longo do programa
    $pont_gpu_final = 0;
    $pont_cpu_final = 0;
    $valor_pc = 0;
    $contWhile = 0;
    $result_pc = false;

    // Caso o desempenho Geral seja nulo ele cria as variáveis para o FPS e o Gráfico avançado
    if($desempenho == null) {
        $fps = $_POST['fps'];
        $grafico = $_POST['grafico'];
    }

    // Da valores de FPS e desempenho caso as opções avançadas não tenham sido ativadas
    if($desempenho !== null){
        if($desempenho == "Baixo"){
            $fps = 60;
            $grafico = "Baixo";
        } elseif($desempenho == "Médio"){
            $fps = 60;
            $grafico = "Médio";
        } elseif($desempenho == "Alto"){
            $fps = 60;
            $grafico = "Alto";
        }
    }

    // Cria um loop para armazenar somente a maior pontuação de GPU e CPU
    for($i = 0; $i < count($array_softwares); $i++){

        // Pega as pontuações da GPU recomendada para rodar os softwares
        $query = "select pontuacao_gpu from requisito_software where nome = '{$array_softwares[$i]}'";
    
        $result_pont_gpu = mysqli_query($mysqli, $query);

        // Cria uma váriavel para armazenar o valor da pontuação vinda do banco de dados
        while ($resultado = $result_pont_gpu->fetch_assoc()) {
            $pontuacao_gpu = $resultado['pontuacao_gpu'];
        } 

        // Armazena a maior pontuação
        if($pont_gpu_final < $pontuacao_gpu){
            $pont_gpu_final = $pontuacao_gpu;
        } 

        // Pega as pontuações da CPU recomendada para rodar os softwares
        $query = "select pontuacao_cpu from requisito_software where nome = '{$array_softwares[$i]}'";

        $result_pont_cpu = mysqli_query($mysqli, $query);

        // Cria uma váriavel para armazenar o valor da pontuação vinda do banco de dados
        while ($resultado = $result_pont_cpu->fetch_assoc()) {
            $pontuacao_cpu = $resultado['pontuacao_cpu'];
        }

        // Armazena a maior pontuação
        if($pont_cpu_final < $pontuacao_cpu){
            $pont_cpu_final = $pontuacao_cpu;
        } 
    }

    // Aumenta os pontos da CPU conforme o requerimento de performance do usuário
    if($fps == 144){
        $pont_cpu_final += 2200;
    }elseif($fps == 240){
        $pont_cpu_final += 4800;
    }elseif ($fps == 360) {
        $pont_cpu_final += 7000;
    }

    // Aumenta os pontos da GPU conforme o requerimento de performance do usuário
    if (strcmp($grafico, "Médio") == 0) {
        $pont_gpu_final += 3000;
    }elseif (strcmp($grafico, "Alto") == 0) {
        $pont_gpu_final += 4200;
    }elseif (strcmp($grafico, "Ultra") == 0) {
        $pont_gpu_final += 6000;
    }
    
    // Cria um loop para gerar o computador
    while($result_pc == false){
        // Consulta o banco de dados para saber quantas CPUs temos cadastradas
        $query = "SELECT COUNT(*) as total_linhas FROM cpu";
        $resultado = mysqli_query($mysqli, $query);

        // Verifica se a consulta foi bem sucedida
        if ($resultado) {
            $row = mysqli_fetch_assoc($resultado);
            $total_cpu = $row['total_linhas'];
        }

        // Caso seja a primeira vez rodando o loop gerará um computador normalmente
        if($contWhile == 0){       
            // Cria um loop para rodar por todas as CPUs cadastradas
            for($i = 0; $i < $total_cpu; $i++){
                // Pega todas as CPUs capazes de rodar nos pré-requisitos
                $query = "select nome_cpu from cpu where pontuacao >= '{$pont_cpu_final}'";

                $resultado_cpu = mysqli_query($mysqli, $query);

                $resultados_cpu = array();

                // Armazena todas as CPUs capazes de rodar nos pré-requisitos num array
                while ($resultado = $resultado_cpu->fetch_assoc()) {
                    array_push($resultados_cpu, $resultado['nome_cpu']);
                }
            }
            // Cria uma váriavel para armazenar o menor valor
            $valorMenorCpu = 999999;

            // Cria um loop para ver os valores das peças
            for($i = 0; $i < count($resultados_cpu); $i++){

                $query = "select preco from cpu where nome_cpu = '{$resultados_cpu[$i]}'";

                $result_preco = mysqli_query($mysqli, $query);

                // Armazena o valor do preço da peça atual do loop
                while ($resultado = $result_preco->fetch_assoc()) {
                    $resultado_preco = $resultado['preco'];
                }

                // Guarda qual o menor valor e o nome da peça mais barata
                if($resultado_preco < $valorMenorCpu){
                    $valorMenorCpu = $resultado_preco;
                    $result_cpu_final = $resultados_cpu[$i];
                }
            }
            // Agrega o valor da peça no valor final do PC
            $valor_pc += $valorMenorCpu;

        }else{
            // Cria um array associativo para armazenar a CPU e sua GPU integrada
            $resultados_cpu = array();

            // Cria um loop para rodar por todas as CPUs cadastradas
            for($i = 0; $i < $total_cpu; $i++){
                // Pega todas as CPUs capazes de rodar nos pré-requisitos
                $query = "select nome_cpu, gpu_integrado from cpu where pontuacao >= '{$pont_cpu_final}' && gpu_integrado != 'NULL'";

                $resultado_cpu = mysqli_query($mysqli, $query);

                // Armazena todas as CPUs capazes de rodar nos pré-requisitos num array
                while ($resultado = $resultado_cpu->fetch_assoc()) {
                    $resultados_cpu[] = array(
                        'nome_cpu' => $resultado['nome_cpu'],
                        'gpu_integrado' => $resultado['gpu_integrado']
                    );
                }
            }

            // Cria um loop para rodar todas as CPUs selecionadas
            for($i = 0; $i < count($resultados_cpu); $i++){
                $resultadoGPU = $resultados_cpu[$i]['gpu_integrado'];
                $resultadoCPU = $resultados_cpu[$i]['nome_cpu'];

                // Fazer uma consulta ao banco de dados para obter a pontuação da GPU integrada
                $query_gpu = "SELECT pontuacao FROM gpu WHERE nome_gpu = '{$resultadoGPU}'";
                
                $resultadoIntegrado = mysqli_query($mysqli, $query_gpu);

                // Armazena a pontuação do gráfico integrado numa variável
                $pontuacao_integrado = mysqli_fetch_assoc($resultadoIntegrado)['pontuacao'];

                // Cria uma condição para passarem somente GPUs com a pontuação necessária
                if($pontuacao_integrado >= $pont_gpu_final){
                    $valorMenorCpu = 999999;

                    $query = "select preco from cpu where nome_cpu = '{$resultadoCPU}'";

                    $result_preco = mysqli_query($mysqli, $query);

                    // Armazena o valor do preço da peça atual do loop
                    while ($resultado = $result_preco->fetch_assoc()) {
                        $resultado_preco = $resultado['preco'];
                    }
                    
                    // Armazena qual a CPU e o gráfico integrado finais
                    if($valorMenorCpu > $resultado_preco){
                        $valorMenorCpu = $resultado_preco;
                        $valorMenorGpu = 0;
                        $result_cpu_final = $resultadoCPU;
                        $result_gpu_final = $resultadoGPU;
                    }
                } 
            } 
        }

        // Procura qual o soquete da CPU selecionada
        $query = "select soquete from cpu where nome_cpu = '{$result_cpu_final}'";

        $result_soquete = mysqli_query($mysqli, $query);
        
        while ($resultado = $result_soquete->fetch_assoc()) {
            $soquete_cpu = $resultado['soquete'];
        } 

        // Procura Placas mãe no banco de dados correspondentes ao soquete da CPU obtida
        $query = "select nome_mae from placa_mae where soquete_mae = '{$soquete_cpu}'";

        $result_mae = mysqli_query($mysqli, $query);
    
        $resultados_mae = array();
    
        // Caso encontre GPUs correspondentes armazena-as no array
        while ($resultado = $result_mae->fetch_assoc()) {
            array_push($resultados_mae, $resultado['nome_mae']);
        }

        // Cria uma váriavel para armazenar o menor valor
        $valorMenorMae = 999999;
        
        // Cria um loop para ver os valores das peças
        for($i = 0; $i < count($resultados_mae); $i++){

            $query = "select preco from placa_mae where nome_mae = '{$resultados_mae[$i]}'";

            $result_preco = mysqli_query($mysqli, $query);

            // Armazena o valor do preço da peça atual do loop
            while ($resultado = $result_preco->fetch_assoc()) {
                $resultado_preco = $resultado['preco'];
            }

            // Guarda qual o menor valor e o nome da peça mais barata
            if($resultado_preco < $valorMenorMae){
                $valorMenorMae = $resultado_preco;
                $result_mae_final = $resultados_mae[$i];
            }
        }

        if($contWhile == 0){  
            // Consulta o banco de dados para saber quantas GPUs temos cadastradas
            $query = "SELECT COUNT(*) as total_linhas FROM gpu";
            $resultado = mysqli_query($mysqli, $query);
        
            // Verifica se a consulta foi bem sucedida
            if ($resultado) {
                $row = mysqli_fetch_assoc($resultado);
                $total_gpu = $row['total_linhas'];
            }
        
            // Cria um loop para rodar por todas as GPUs cadastradas
            for($i = 0; $i < $total_gpu; $i++){
                // Pega todas as GPUs capazes de rodar nos pré-requisitos
                $query = "select nome_gpu from gpu where pontuacao >= '{$pont_gpu_final}' && marca != 'Intel'";
        
                $resultado_gpu = mysqli_query($mysqli, $query);
        
                $resultados_gpu = array();
        
                // Armazena todas as GPUs capazes de rodar nos pré-requisitos num array
                while ($resultado = $resultado_gpu->fetch_assoc()) {
                    array_push($resultados_gpu, $resultado['nome_gpu']);
                }
            }   
        
            // Cria uma váriavel para armazenar o menor valor
            $valorMenorGpu = 999999;
        
            // Cria um loop para ver os valores das peças
            for($i = 0; $i < count($resultados_gpu); $i++){
        
                $query = "select preco from gpu where nome_gpu = '{$resultados_gpu[$i]}'";
        
                $result_preco = mysqli_query($mysqli, $query);
        
                // Armazena o valor do preço da peça atual do loop
                while ($resultado = $result_preco->fetch_assoc()) {
                    $resultado_preco = $resultado['preco'];
                }
        
                // Guarda qual o menor valor e o nome da peça mais barata
                if($resultado_preco < $valorMenorGpu){
                    $valorMenorGpu = $resultado_preco;
                    $result_gpu_final = $resultados_gpu[$i];
                }
            }
        }

        $valor_pc = $valorMenorCpu + $valorMenorMae + $valorMenorGpu;

        if($valor_pc <= $orcamento){
            session_start();

            $_SESSION['cpu'] = $result_cpu_final;
            $_SESSION['gpu'] = $result_gpu_final;
            $_SESSION['placaMae'] = $result_mae_final;
            $_SESSION['precoCpu'] = $valorMenorCpu;
            $_SESSION['precoGpu'] = $valorMenorGpu;
            $_SESSION['precoMae'] = $valorMenorMae;
            $_SESSION['precoPc'] = $valor_pc;
    
            $result_pc = true;
        }elseif($contWhile == 0){
            $contWhile++;
        }else{
            $_SESSION['erro'] = "Não é possível montar um PC que cumpra os requisitos com o orçamento atual!";
            
            $result_pc = true;
        }
    }
?>