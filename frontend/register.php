    <?php
    include_once 'components/head.php';
    include_once 'components/header.php';
    ?>

    <div class="container">

        <h1>Registrar Pack de fotos</h1>
        <form action="uploadImages.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título do pack</label>
                <input required type="text" name="titulo" class="form-control" id="titulo" placeholder="Mil e uma ideias">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição do pack</label>
                <textarea required class="form-control" id="descricao" name="descricao" rows="3"></textarea>
            </div>
            <div class="mb-3" style="color: red;">
                ** ATENÇÃO, SELECIONE VARIOS ARQUIVOS DE UMA VEZ **
            </div>
            <div class="container">
                <div id="drop_zone" class="border p-3 text-center">
                    <input type="file" required id="file_input" multiple name="imagens[]">

                </div>
                <div id="uploaded_images" class="mt-3">
                    <!-- As imagens soltas aparecerão aqui -->
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success">Registrar Pack de fotos</button>
        </form>
    </div>

    <script src="assets/js/axiosbase.js"></script>
    <script src="assets/js/post.js"></script>
    </body>

    </html>