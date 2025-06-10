// script-menu.js

document.addEventListener("DOMContentLoaded", () => {
  const editProfileBtn = document.getElementById("editProfileBtn");
  const editProfileModal = document.getElementById("editProfileModal");
  const closeModalBtn = document.getElementById("closeModalBtn");

  const editImageInput = document.getElementById("editImage");
  const imageCropper = document.getElementById("imageCropper");
  const croppedImageInput = document.getElementById("croppedImage");
  const editProfileForm = document.getElementById("editProfileForm");

  let cropper = null;

  // Abrir modal
  editProfileBtn.addEventListener("click", () => {
    editProfileModal.style.display = "flex";
  });

  // Fechar modal
  closeModalBtn.addEventListener("click", () => {
    editProfileModal.style.display = "none";
    resetCropper();
  });

  // Fecha modal se clicar fora do conteúdo
  window.addEventListener("click", (e) => {
    if (e.target === editProfileModal) {
      editProfileModal.style.display = "none";
      resetCropper();
    }
  });

  // Quando seleciona arquivo
  editImageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (!file) return;

    const url = URL.createObjectURL(file);

    // Mostrar imagem para cropper
    imageCropper.src = url;
    imageCropper.style.display = "block";

    // Destruir cropper anterior, se houver
    if (cropper) cropper.destroy();

    // Criar novo cropper
    cropper = new Cropper(imageCropper, {
      aspectRatio: 1, // Quadrado, para avatar
      viewMode: 1,
      movable: true,
      zoomable: true,
      rotatable: false,
      scalable: false,
      cropBoxResizable: true,
      minCropBoxWidth: 100,
      minCropBoxHeight: 100,
      background: false,
      autoCropArea: 1,
    });
  });

  // Antes de enviar o form, gera a imagem cortada em base64
  editProfileForm.addEventListener("submit", (e) => {
    if (cropper) {
      e.preventDefault();

      // Gera a imagem cortada (200x200)
      const canvas = cropper.getCroppedCanvas({
        width: 200,
        height: 200,
        imageSmoothingQuality: "high",
      });

      // Pega base64 e seta no input escondido
      croppedImageInput.value = canvas.toDataURL("image/png");

      // Agora pode enviar o form normalmente
      editProfileForm.submit();
    }
  });

  function resetCropper() {
    if (cropper) {
      cropper.destroy();
      cropper = null;
    }
    imageCropper.src = "";
    imageCropper.style.display = "none";
    croppedImageInput.value = "";
    editImageInput.value = "";
  }
});
