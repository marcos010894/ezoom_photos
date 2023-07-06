<?php
include_once 'components/head.php';
include_once 'components/header.php';
?>




<div class="container">
    <div class="row" id="cards_items">

    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" <h2>Grid Gallery</h2>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="gallery-block grid-gallery">
                    <div class="container">
                        <div class="row" id="gallery_items">

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer" id="button_download">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!--MODAL ############################################################-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="assets/js/axiosbase.js"></script>

<script>
    async function getAllDados() {
        await api.get('packs').then(doc => {
            loading(true)
            let data = doc.data
            data.forEach(doc => {
                document.getElementById('cards_items').innerHTML += `
                    <div class="col-md-6 col-xl-3 col-lg-6 col-sm-6 ">
                        <div class="card" style="width: auto;">
                            <img class="card-img-top" src=${doc.images[0].url_img}
                                alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">${doc.title}</h5>
                                <p>${doc.description}</p>
                            </div>
                            <div class="card-body">
                                <a href="download.php?id=${doc.id}&name=${doc.title}"  class="card-link">Download Pack</a>
                                <a href="#"  onclick='viewFotos(${doc.id})' class="card-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ver
                                    fotos</a>
                            </div>
                        </div>
                    </div>
                    `
            })

        })
        loading()
    }

    getAllDados()

    const viewFotos = async (id) => {


        await api.get('packs/' + id).then(doc => {
            loading(true)
            let data = doc.data
            document.getElementById('gallery_items').innerHTML = ''
            data.images.forEach(doc => {
                document.getElementById('gallery_items').innerHTML += `
                    <div class="col-md-6 col-lg-6 item">
                        <a class="lightbox" href="-square-windows.jpg">
                            <img class="img-fluid image scale-on-hover"
                                src="${doc.url_img}">
                        </a>
                    </div>
                    `
            })

        })
        loading()

    }
</script>
</body>

</html>