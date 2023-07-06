<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter os dados do formulário
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    if (isset($_FILES['imagens'])) {
        $imagensEnviadas = $_FILES['imagens'];
        $imagensUrls = [];

       
        $diretorioUpload = 'uploads/';


        echo json_encode($imagensEnviadas);
       
        foreach ($imagensEnviadas['tmp_name'] as $key => $tmpNomeImagem) {
            $nomeImagem = $imagensEnviadas['name'][$key];
        
            $timestamp = round(microtime(true) * 1000);

            
            $randomValue = rand(10000, 99999);

            
            $originalName = $nomeImagem; 
          
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);

           
            $nomeImagemSalvar = 'img_' . $timestamp . '_' . $randomValue . '.' . $extension;

            $erroImagem = $imagensEnviadas['error'][$key];
            echo $key . '<br>';
            if ($erroImagem === UPLOAD_ERR_OK) {
                $caminhoUpload = $diretorioUpload . basename($nomeImagemSalvar);

              
                if (move_uploaded_file($tmpNomeImagem, $caminhoUpload)) {
                 
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



    
        $jsonPack = json_encode($dadosPack);


        if (isset($_GET['type'])) {

            $ch = curl_init();

           
            $url = 'http://127.0.0.1:8000/api/packs/' . $_GET['id_edit']; // Substitua {id} pelo ID da entidade que deseja atualizar

         
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPack);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            
            $response = curl_exec($ch);

         
            if (curl_errno($ch)) {
                $error = curl_error($ch);
          

                echo 'Erro na requisição cURL: ' . $error;
            }

          
            curl_close($ch);

           
            echo $response;
        } else {
        
            $ch = curl_init();

           
            $url = 'http://127.0.0.1:8000/api/packs';

      
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPack);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          
            $response = curl_exec($ch);

           
            if (curl_errno($ch)) {
                $error = curl_error($ch);
               

                echo 'Erro na requisição cURL: ' . $error;
            }

           
            curl_close($ch);

        
            echo $response;
        }
    }
}
