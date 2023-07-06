<?php
include_once 'components/head.php';
include_once 'components/header.php';
?>

<div class="container">
    <h1>Editar Pack de fotos</h1>
    <form action="uploadImages.php?type=PUT&id_edit=25" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titulo do pack</label>
            <input required type="text" name="titulo" class="form-control" id="titulo" placeholder="Mil e uma ideias">
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Descrição do pack</label>
            <textarea required class="form-control" id="descricao" name="descricao" rows="3"></textarea>
        </div>

        <div class="mb-3">
            A imagens disponiveis estão aqui:
        </div>
        <div class="img_edits" id="img_exist">


        </div>


        <div class="container">
            <div id="drop_zone" class="border p-3 text-center">
                ADICIONAR NOVAS IMAGENS ? <br>
                <input type="file" name="imagens[]" id="file_input" multiple>

            </div>
            <div id="uploaded_images" class="mt-3">

            </div>
        </div>
        <button type="submits" style="margin-bottom: 49px;" class="btn btn-outline-success">Editar Pack de fotos</button>
    </form>
</div>

<script src="assets/js/axiosbase.js"></script>
<script src="assets/js/edit.js"></script>
</body>

</html>