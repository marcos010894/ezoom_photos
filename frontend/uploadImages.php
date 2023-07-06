<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    // Criar um novo registro na tabela Pack com o título e a descrição
    // Aqui você deve adicionar a lógica para salvar os dados na tabela Pack

    // Verificar se há imagens enviadas
    if (isset($_FILES['imagens'])) {
        $imagensEnviadas = $_FILES['imagens'];
        $imagensUrls = [];

        // Diretório de upload
        $diretorioUpload = 'uploads/';


        echo json_encode($imagensEnviadas);
        // Percorrer as imagens enviadas
        foreach ($imagensEnviadas['tmp_name'] as $key => $tmpNomeImagem) {
            $nomeImagem = $imagensEnviadas['name'][$key];
            // Obtém o timestamp atual em milissegundos
            $timestamp = round(microtime(true) * 1000);

            // Gera um valor aleatório entre 10000 e 99999
            $randomValue = rand(10000, 99999);

            // Supondo que você tem o nome original do arquivo
            $originalName = $nomeImagem; // ou qualquer outro nome de arquivo

            // Obtém a extensão do arquivo
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);

            // Combina os valores para formar o nome da imagem
            $nomeImagemSalvar = 'img_' . $timestamp . '_' . $randomValue . '.' . $extension;

            $erroImagem = $imagensEnviadas['error'][$key];
            echo $key . '<br>';
            if ($erroImagem === UPLOAD_ERR_OK) {
                $caminhoUpload = $diretorioUpload . basename($nomeImagemSalvar);

                // Mover a imagem para o diretório de upload
                if (move_uploaded_file($tmpNomeImagem, $caminhoUpload)) {
                    // Adicionar a URL da imagem ao array de URLs
                    $imagensUrls[] = $caminhoUpload;
                } else {
                    echo 'Erro ao mover o arquivo ' . $nomeImagem . ' para o diretório de upload.';
                }
            } else {
                echo 'Erro no upload da imagem ' . $nomeImagem . ': ' . $erroImagem;
            }
        }
        // Montar o JSON com os dados do pack e as URLs das imagens
        $dadosPack = [
            'title' => $titulo,
            'description' => $descricao,
            'images' => $imagensUrls
        ];



        // Converter o array em JSON
        $jsonPack = json_encode($dadosPack);


        if (isset($_GET['type'])) {
            // Inicializar a sessão cURL
            $ch = curl_init();

            // Definir a URL de destino
            $url = 'http://127.0.0.1:8000/api/packs/' . $_GET['id_edit']; // Substitua {id} pelo ID da entidade que deseja atualizar

            // Configurar as opções do cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPack);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Executar a requisição cURL e obter a resposta
            $response = curl_exec($ch);

            // Verificar se ocorreu algum erro
            if (curl_errno($ch)) {
                $error = curl_error($ch);
                // Tratar o erro de acordo com a sua necessidade

                echo 'Erro na requisição cURL: ' . $error;
            }

            // Fechar a sessão cURL
            curl_close($ch);

            // Exibir a resposta da API
            echo $response;
        } else {
            // Inicializar a sessão cURL
            $ch = curl_init();

            // Definir a URL de destino
            $url = 'http://127.0.0.1:8000/api/packs';

            // Configurar as opções do cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPack);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Executar a requisição cURL e obter a resposta
            $response = curl_exec($ch);

            // Verificar se ocorreu algum erro
            if (curl_errno($ch)) {
                $error = curl_error($ch);
                // Tratar o erro de acordo com a sua necessidade

                echo 'Erro na requisição cURL: ' . $error;
            }

            // Fechar a sessão cURL
            curl_close($ch);

            // Exibir a resposta da API
            echo $response;
        }
    }
}
