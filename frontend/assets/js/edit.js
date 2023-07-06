document.addEventListener("DOMContentLoaded", (event) => {
  const dropZone = document.getElementById("drop_zone");
  const uploadedImages = document.getElementById("uploaded_images");
  const fileInput = document.getElementById("file_input");

  function handleFiles(files) {
    document.getElementById("uploaded_images").innerHTML = "";
    Array.from(files).forEach((file) => {
      if (!file.type.startsWith("image/")) {
        return;
      }

      const reader = new FileReader();

      reader.onload = function (e) {
        // Cria a imagem
        const img = document.createElement("img");
        img.src = e.target.result;
        img.classList.add("thumbnail-image", "mr-2", "mt-2");

        // Cria o botão de remover
        const removeButton = document.createElement("button");
        removeButton.textContent = "Remover";
        removeButton.classList.add(
          "btn",
          "btn-outline-danger",
          "btn-sm",
          "mt-2"
        );

        // Cria um div para conter a imagem e o botão
        const div = document.createElement("div");
        div.classList.add("thumbnail-container", "d-inline-block", "mr-2");

        // Adiciona a imagem e o botão ao div
        div.appendChild(img);
        div.appendChild(removeButton);

        // Adiciona o div à zona de imagens carregadas
        uploadedImages.appendChild(div);

        // Adiciona um evento de clique ao botão de remover
        removeButton.addEventListener("click", function (e) {
          uploadedImages.removeChild(div);
        });
      };

      reader.readAsDataURL(file);
    });
  }

  function createImageElement(src) {
    // Cria a imagem
    const img = document.createElement("img");
    img.src = src;
    img.classList.add("thumbnail-image", "mr-2", "mt-2");

    // Cria o botão de remover
    const removeButton = document.createElement("button");
    removeButton.textContent = "Remover";
    removeButton.classList.add("btn", "btn-outline-danger", "btn-sm", "mt-2");

    // Cria um div para conter a imagem e o botão
    const div = document.createElement("div");
    div.classList.add("thumbnail-container", "d-inline-block", "mr-2");

    // Adiciona a imagem e o botão ao div
    div.appendChild(img);
    div.appendChild(removeButton);

    // Adiciona o div à zona de imagens carregadas
    uploadedImages.appendChild(div);

    // Adiciona um evento de clique ao botão de remover
    removeButton.addEventListener("click", function (e) {
      uploadedImages.removeChild(div);
    });
  }

  dropZone.addEventListener("click", (e) => {
    fileInput.click();
  });

  fileInput.addEventListener("change", (e) => {
    handleFiles(e.target.files);
  });

  dropZone.addEventListener("dragleave", (e) => {
    e.preventDefault();
    dropZone.classList.remove("bg-light");
  });

  dropZone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropZone.classList.remove("bg-light");
    handleFiles(e.dataTransfer.files);
  });
});
let params = new URLSearchParams(window.location.search);
var id_URL = params.get("id"); // O valor será '1234'
const viewFotos = async (id) => {
  document.getElementById("img_exist").innerHTML = ``;
  await api.get("packs/" + id).then((doc) => {
    loading(true);
    let data = doc.data;
    document.getElementById("titulo").value = data.title;
    document.getElementById("descricao").value = data.description;
    data.images.forEach((doc) => {
      document.getElementById("img_exist").innerHTML += `
        <div>
            <img src="${doc.url_img}" alt="">
            <a href="#" class="btn btn-danger" onclick="remove_img('${doc.id}', '${doc.url_img}')">Remover Item</a >
        </div>`;
    });
  });

  loading();
};
viewFotos(id_URL);

async function remove_img(id, url) {
  loading(true);
  await axios
    .post("deletarImage.php", {
      imageSrc: url,
    })
    .then(function (response) {
      api.delete("images/" + id).then((doc) => {
        //sucesso
        viewFotos(id_URL);
      });
    })
    .catch(function (error) {
      console.log(error);
    });

  loading();
}

$(document).ready(function () {
  $("form").on("submit", function (event) {
    loading(true);
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "uploadImages.php?type=PUT&id_edit=" + id_URL,
      type: "POST",
      data: formData,
      success: function (data) {
        window.location.href = "list.php";
        $("#uploaded_images").empty();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Aqui você pode adicionar seu código de tratamento de erros
        alert(
          "Ocorreu um erro ao enviar o formulário: " +
            textStatus +
            " " +
            errorThrown
        );
      },
      cache: false,
      contentType: false,
      processData: false,
    });

    loading();
  });
});
