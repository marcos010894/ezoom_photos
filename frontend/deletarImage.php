<?php
$imageSrc = $_POST['imageSrc'];


$imageSrc = str_replace('http://meusite.com/imagens/', '', $imageSrc);


$dir = '';

if (unlink($dir . $imageSrc)) {
    echo 'Arquivo ' . $imageSrc . ' foi deletado';
} else {
    echo 'Erro ao deletar o arquivo ' . $imageSrc;
}
