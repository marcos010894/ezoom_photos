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

  dropZone.addEventListener("click", (e) => {
    fileInput.click();
  });

  fileInput.addEventListener("change", (e) => {
    handleFiles(e.target.files);
  });

  // dropZone.addEventListener('dragover', (e) => {
  //     e.preventDefault();
  //     dropZone.classList.add('bg-light');
  // });

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

$(document).ready(function () {
  $("form").on("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "uploadImages.php",
      type: "POST",
      data: formData,
      success: function (data) {
        window.location.href = "list.php";
        $("form")[0].reset(); // Reset form fields
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
  });
});
