<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_GET['name'];

    // Faça a requisição para obter os dados do pack
    $response = file_get_contents('http://localhost:8000/api/packs/' . $id);
    $data = json_decode($response, true);

    // Verifica se a requisição foi bem-sucedida
    if ($data && isset($data['images']) && !empty($data['images'])) {
        // Cria um arquivo ZIP para armazenar as imagens
        $zip = new ZipArchive();
        $zipFilename = $name . '.zip';

        if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($data['images'] as $image) {
                $imageUrl = $image['url_img'];
                $imageFilename = basename($imageUrl);

                // Baixa a imagem do URL e adiciona ao arquivo ZIP
                $imageData = file_get_contents($imageUrl);
                $zip->addFromString($imageFilename, $imageData);
            }

            $zip->close();

            // Define o cabeçalho para download do arquivo ZIP
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
            header('Content-Length: ' . filesize($zipFilename));
            readfile($zipFilename);

            // Exclui o arquivo ZIP após o download
            unlink($zipFilename);
            exit;
        } else {
            echo 'Erro ao criar arquivo ZIP.';
        }
    } else {
        echo 'Não foi possível obter os dados do pack.';
    }
} else {
    echo 'ID do pack não fornecido.';
}
