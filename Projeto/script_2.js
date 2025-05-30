// Função para buscar anime e redirecionar conforme o termo
function buscarAnime() {
  const termo = document.getElementById('searchInput').value.toLowerCase();

  if (
    termo.includes("one piece") || termo.includes("chainsaw ") || termo.includes("kimetsu") || termo.includes("edens zero") ||
    termo.includes("naruto") || termo.includes("black clover") || termo.includes("dragon ball z") || termo.includes("one punch")
  ) {
    window.location.href = `./generos/shounen.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("devil may cry") || termo.includes("lazarus") || termo.includes("to be hero x") || termo.includes("kijun") ||
    termo.includes("tougen anki") || termo.includes("gachiakuta") || termo.includes("shangri la") || termo.includes("zenchu")
  ) {
    window.location.href = `./generos/lancamentos.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("iruma") || termo.includes("kaguya") || termo.includes("nagatoro") || termo.includes("osomatsu") ||
    termo.includes("usurei yatsura") || termo.includes("gintama") || termo.includes("konosuba") || termo.includes("prison")
  ) {
    window.location.href = `./generos/comedia.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("darling") || termo.includes("sono bisque doll") || termo.includes("komi") || termo.includes("nisekoi") ||
    termo.includes("bunny girl senpai") || termo.includes("the ancient magus bride") || termo.includes("call of the night") || termo.includes("jitsu wa watashi wa")
  ) {
    window.location.href = `./generos/romance.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("attack on titan") || termo.includes("berserk") || termo.includes("hellsing") || termo.includes("monster") ||
    termo.includes("cowboy bebop") || termo.includes("devilman") || termo.includes("death note") || termo.includes("erased")
  ) {
    window.location.href = `./generos/seinein.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("evangelion") || termo.includes("code geass") || termo.includes("mecha-ude") || termo.includes("gurren lagann") ||
    termo.includes("mobile suit") || termo.includes("cannon busters") || termo.includes("valvrave") || termo.includes("ssss")
  ) {
    window.location.href = `./generos/mecha.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("shiki") || termo.includes("another") || termo.includes("uzumaki") || termo.includes("blood c") ||
    termo.includes("boogiepop") || termo.includes("ghost hunt") || termo.includes("mieruko") || termo.includes("corpse party")
  ) {
    window.location.href = `./generos/terror.php?anime=${encodeURIComponent(termo)}`;
  } else if (
    termo.includes("digimon 4") || termo.includes("so i'm a spider") || termo.includes("re:zero") || termo.includes("overlord") ||
    termo.includes("no game no life") || termo.includes("slime") || termo.includes("mushoku tensei") || termo.includes("shield hero")
  ) {
    window.location.href = `./generos/isekai.php?anime=${encodeURIComponent(termo)}`;
  }
}

// --- INÍCIO da parte do perfil ---

let cropper;
const LOCAL_STORAGE_KEY = 'user';

// Função para criar um novo usuário com imagem padrão
function criarUsuarioPadrao(name, email, password) {
  const novoUsuario = {
    name: name,
    email: email,
    password: password,
    profileImage: "./imagens/usuario_padrao.png"  // imagem padrão para novos usuários
  };
  localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(novoUsuario));
  return novoUsuario;
}

function carregarDadosUsuario() {
  const storedUserStr = localStorage.getItem(LOCAL_STORAGE_KEY);
  if (!storedUserStr) {
    window.location.href = 'index.php'; // Redireciona se não estiver logado
    return null;
  }

  const storedUser = JSON.parse(storedUserStr);

  // Atualiza menu com dados do usuário
  const userNameElem = document.getElementById('userName');
  const userEmailElem = document.getElementById('userEmail');
  const userImageElem = document.getElementById('userImage');

  if (userNameElem) userNameElem.textContent = storedUser.name || "Usuário";
  if (userEmailElem) userEmailElem.textContent = storedUser.email || "";
  if (userImageElem) {
    userImageElem.src = storedUser.profileImage || "./imagens/usuario_padrao.jpg";
    userImageElem.alt = `Foto de perfil de ${storedUser.name || "Usuário"}`;
  }

  return storedUser;
}

function configurarLogout() {
  const logoutBtn = document.getElementById('logoutBtn');
  if (!logoutBtn) return;

  logoutBtn.addEventListener('click', () => {
    localStorage.removeItem(LOCAL_STORAGE_KEY);
    window.location.href = 'index.php';
  });
}

document.addEventListener('DOMContentLoaded', () => {
  let storedUser = carregarDadosUsuario();
  if (!storedUser) return;

  const modal = document.getElementById('editProfileModal');
  const openBtn = document.getElementById('editProfileBtn');
  const closeBtn = document.getElementById('closeModalBtn');
  const form = document.getElementById('editProfileForm');
  const preview = document.getElementById('profileImagePreview');
  const nameInput = document.getElementById('editName');
  const emailInput = document.getElementById('editEmail');
  const imageInput = document.getElementById('editImage');

  const userNameDisplay = document.getElementById('userName');
  const userEmailDisplay = document.getElementById('userEmail');
  const userImageDisplay = document.getElementById('userImage');

  // Abrir modal e preencher com dados atuais
  if(openBtn){
    openBtn.addEventListener('click', () => {
      nameInput.value = storedUser.name || "";
      emailInput.value = storedUser.email || "";
      preview.src = storedUser.profileImage || "./imagens/usuario_padrao.jpg";

      // Se já tiver cropper ativo, destrói
      if (cropper) {
        cropper.destroy();
        cropper = null;
      }
      // Inicializa cropper no preview
      cropper = new Cropper(preview, {
        aspectRatio: 1,
        viewMode: 1,
        autoCropArea: 1,
        movable: true,
        zoomable: true,
        rotatable: false,
        scalable: false,
        background: false,
      });

      modal.style.display = "flex";
    });
  }

  // Fechar modal
  if(closeBtn){
    closeBtn.addEventListener('click', () => {
      modal.style.display = "none";
      if (cropper) {
        cropper.destroy();
        cropper = null;
      }
      preview.src = "";
      imageInput.value = "";
    });
  }

  // Trocar imagem no input e atualizar cropper
  if(imageInput){
    imageInput.addEventListener('change', () => {
      const file = imageInput.files[0];
      if (file) {
        const url = URL.createObjectURL(file);
        preview.src = url;

        if (cropper) {
          cropper.destroy();
        }

        cropper = new Cropper(preview, {
          aspectRatio: 1,
          viewMode: 1,
          autoCropArea: 1,
          movable: true,
          zoomable: true,
          rotatable: false,
          scalable: false,
          background: false,
        });
      }
    });
  }

  // Salvar dados do perfil editado
  if(form){
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      let croppedImage = preview.src; // fallback

      if (cropper) {
        croppedImage = cropper.getCroppedCanvas({
          width: 150,
          height: 150,
          fillColor: '#fff'
        }).toDataURL('image/png');
      }

      const updatedUser = {
        name: nameInput.value.trim(),
        email: emailInput.value.trim(),
        password: storedUser.password || "", // mantém a senha antiga
        profileImage: croppedImage
      };

      localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(updatedUser));
      alert("Perfil atualizado com sucesso!");

      // Atualiza menu
      if (userNameDisplay) userNameDisplay.textContent = updatedUser.name;
      if (userEmailDisplay) userEmailDisplay.textContent = updatedUser.email;
      if (userImageDisplay) {
        userImageDisplay.src = updatedUser.profileImage;
        userImageDisplay.alt = `Foto de perfil de ${updatedUser.name}`;
      }

      modal.style.display = "none";

      // Destrói cropper após salvar
      if (cropper) {
        cropper.destroy();
        cropper = null;
      }

      // Limpa preview e input
      preview.src = "";
      imageInput.value = "";
    });
  }

  configurarLogout();
});
