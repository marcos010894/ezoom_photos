<?php
include_once 'components/head.php';
include_once 'components/header.php';
?>

    <div class="container">

        <h1>Registrar Pack de fotos</h1>
        <form action="">
            <div class="mb-3">
                <label for="title" class="form-label">Titulo do pack</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Mil e uma ideias">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Descrição do pack</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <div class="mb-3">
                ** ATENÇÂO, A PRIMEIRA FOTO DA LISTA SERÁ A FOTO DE CAPA O PACK **
            </div>
            <div class="container">
                <div id="drop_zone" class="border p-3 text-center">
                    Arraste e solte suas imagens ou clique aqui
                    <input type="file" id="file_input" multiple style="display: none;">

                </div>
                <div id="uploaded_images" class="mt-3">
                    <!-- As imagens soltas aparecerão aqui -->
                </div>
            </div>
            <button type="button" class="btn btn-outline-success"> Registrar Pack de fotos </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const dropZone = document.getElementById('drop_zone');
            const uploadedImages = document.getElementById('uploaded_images');
            const fileInput = document.getElementById('file_input');

            function handleFiles(files) {
                Array.from(files).forEach((file) => {
                    if (!file.type.startsWith('image/')) { return; }

                    const reader = new FileReader();

                    reader.onload = function (e) {
                        // Cria a imagem
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('thumbnail-image', 'mr-2', 'mt-2');

                        // Cria o botão de remover
                        const removeButton = document.createElement('button');
                        removeButton.textContent = 'Remover';
                        removeButton.classList.add('btn', 'btn-outline-danger', 'btn-sm', 'mt-2');

                        // Cria um div para conter a imagem e o botão
                        const div = document.createElement('div');
                        div.classList.add('thumbnail-container', 'd-inline-block', 'mr-2');

                        // Adiciona a imagem e o botão ao div
                        div.appendChild(img);
                        div.appendChild(removeButton);

                        // Adiciona o div à zona de imagens carregadas
                        uploadedImages.appendChild(div);

                        // Adiciona um evento de clique ao botão de remover
                        removeButton.addEventListener('click', function (e) {
                            uploadedImages.removeChild(div);
                        });
                    };

                    reader.readAsDataURL(file);
                });
            }

            dropZone.addEventListener('click', (e) => {
                fileInput.click();
            });

            fileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
            });

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('bg-light');
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.classList.remove('bg-light');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('bg-light');
                handleFiles(e.dataTransfer.files);
            });
        });
    </script>
</body>

</html>