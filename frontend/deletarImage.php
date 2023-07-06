<?php
$imageSrc = $_POST['imageSrc'];

// Aqui você precisa remover a parte da URL que não faz parte do caminho do arquivo, isso depende de como sua URL está estruturada
$imageSrc = str_replace('http://meusite.com/imagens/', '', $imageSrc);

// Aqui você precisa especificar o caminho do diretório onde as imagens são armazenadas
$dir = '';

if (unlink($dir . $imageSrc)) {
    echo 'Arquivo ' . $imageSrc . ' foi deletado';
} else {
    echo 'Erro ao deletar o arquivo ' . $imageSrc;
}
