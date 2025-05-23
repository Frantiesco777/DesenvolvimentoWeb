// Função para buscar anime e redirecionar conforme o termo
function buscarAnime() {
  const termo = document.getElementById('searchInput').value.toLowerCase();

  if (
    termo.includes("one piece") || termo.includes("chainsaw ") || termo.includes("kimetsu") || termo.includes("edens zero") ||
    termo.includes("naruto") || termo.includes("black clover") || termo.includes("dragon ball z") || termo.includes("one punch")
  ) {
    window.location.href = `./generos/shounen.php?anime=${termo}`;
  } else if (
    termo.includes("devil may cry") || termo.includes("lazarus") || termo.includes("to be hero x") || termo.includes("kijun") ||
    termo.includes("tougen anki") || termo.includes("gachiakuta") || termo.includes("shangri la") || termo.includes("zenchu")
  ) {
    window.location.href = `./generos/lancamentos.php?anime=${termo}`;
  } else if (
    termo.includes("iruma") || termo.includes("kaguya") || termo.includes("nagatoro") || termo.includes("osomatsu") ||
    termo.includes("usurei yatsura") || termo.includes("gintama") || termo.includes("konosuba") || termo.includes("prison")
  ) {
    window.location.href = `./generos/comedia.php?anime=${termo}`;
  } else if (
    termo.includes("darling") || termo.includes("sono bisque doll") || termo.includes("komi") || termo.includes("nisekoi") ||
    termo.includes("bunny girl senpai") || termo.includes("the ancient magus bride") || termo.includes("call of the night") || termo.includes("jitsu wa watashi wa")
  ) {
    window.location.href = `./generos/romance.php?anime=${termo}`;
  } else if (
    termo.includes("attack on titan") || termo.includes("berserk") || termo.includes("hellsing") || termo.includes("monster") ||
    termo.includes("cowboy bebop") || termo.includes("devilman") || termo.includes("death note") || termo.includes("erased")
  ) {
    window.location.href = `./generos/seinein.php?anime=${termo}`;
  } else if (
    termo.includes("evangelion") || termo.includes("code geass") || termo.includes("mecha-ude") || termo.includes("gurren lagann") ||
    termo.includes("mobile suit") || termo.includes("cannon busters") || termo.includes("valvrave") || termo.includes("ssss")
  ) {
    window.location.href = `./generos/mecha.php?anime=${termo}`;
  } else if (
    termo.includes("shiki") || termo.includes("another") || termo.includes("uzumaki") || termo.includes("blood c") ||
    termo.includes("boogiepop") || termo.includes("ghost hunt") || termo.includes("mieruko") || termo.includes("corpse party")
  ) {
    window.location.href = `./generos/terror.php?anime=${termo}`;
  } else if (
    termo.includes("digimon 4") || termo.includes("so i'm a spider") || termo.includes("re:zero") || termo.includes("overlord") ||
    termo.includes("no game no life") || termo.includes("slime") || termo.includes("mushoku tensei") || termo.includes("shield hero")
  ) {
    window.location.href = `./generos/isekai.php?anime=${termo}`;
  }
}

// Função para carregar os dados do usuário e preencher no menu
function carregarDadosUsuario() {
  const storedUser = JSON.parse(localStorage.getItem('user'));

  if (!storedUser) {
    // Se não estiver logado, redireciona para a página de login
    window.location.href = 'index.php';
    return;
  }

  // Pega os elementos do DOM do menu
  const userNameElem = document.getElementById('userName');
  const userEmailElem = document.getElementById('userEmail');
  const userImageElem = document.getElementById('userImage');

  // Preenche os dados do usuário no menu
  userNameElem.textContent = storedUser.name || "Usuário";
  userEmailElem.textContent = storedUser.email || "";
  userImageElem.src = storedUser.profileImage || "./imagens/perfil.png";
  userImageElem.alt = `Foto de perfil de ${storedUser.name || "Usuário"}`;
}

// Função para configurar o botão de logout
function configurarLogout() {
  const logoutBtn = document.getElementById('logoutBtn');
  if (!logoutBtn) return;

  logoutBtn.addEventListener('click', () => {
    // Remove os dados do usuário e redireciona para a página de login
    localStorage.removeItem('user');
    window.location.href = 'index.php';
  });
}

// Função para carregar foto de perfil na edição e menu
function carregarFotoPerfil() {
  const storedUser = JSON.parse(localStorage.getItem('user'));
  if (storedUser && storedUser.profileImage) {
    const userImageElem = document.getElementById('userImage');
    if(userImageElem){
      userImageElem.src = storedUser.profileImage;
      userImageElem.alt = `Foto de perfil de ${storedUser.name || "Usuário"}`;
    }

    const profileImagePreview = document.getElementById('profileImagePreview');
    if (profileImagePreview) {
      profileImagePreview.src = storedUser.profileImage;
    }
  }
}

// Evento para mostrar preview da imagem selecionada no input file (edição perfil)
const profileImageInput = document.getElementById('profileImageInput');
if (profileImageInput) {
  profileImageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
      const profileImagePreview = document.getElementById('profileImagePreview');
      if(profileImagePreview) profileImagePreview.src = e.target.result;
    };
    reader.readAsDataURL(file);
  });
}

// Evento para salvar a imagem no localStorage e atualizar o menu (edição perfil)
const saveProfileImageBtn = document.getElementById('saveProfileImageBtn');
if (saveProfileImageBtn) {
  saveProfileImageBtn.addEventListener('click', () => {
    const profileImagePreview = document.getElementById('profileImagePreview');
    if(!profileImagePreview) return;

    const newImage = profileImagePreview.src;

    let storedUser = JSON.parse(localStorage.getItem('user')) || {};
    storedUser.profileImage = newImage;
    localStorage.setItem('user', JSON.stringify(storedUser));

    // Atualiza a foto no menu imediatamente
    const userImageElem = document.getElementById('userImage');
    if(userImageElem) userImageElem.src = newImage;

    alert('Foto de perfil atualizada com sucesso!');
  });
}

// Código para abrir/fechar modal de edição e salvar dados atualizados do perfil
document.addEventListener('DOMContentLoaded', () => {
  const storedUser = JSON.parse(localStorage.getItem('user'));
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

  if(openBtn){
    openBtn.addEventListener('click', () => {
      nameInput.value = storedUser.name || "";
      emailInput.value = storedUser.email || "";
      preview.src = storedUser.profileImage || "./imagens/perfil.png";
      modal.style.display = "flex";
    });
  }

  if(closeBtn){
    closeBtn.addEventListener('click', () => {
      modal.style.display = "none";
    });
  }

  if(imageInput){
    imageInput.addEventListener('change', () => {
      const file = imageInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  }

  if(form){
    form.addEventListener('submit', (e) => {
      e.preventDefault();

      const updatedUser = {
        name: nameInput.value,
        email: emailInput.value,
        password: storedUser.password, // mantém a senha original
        profileImage: preview.src
      };

      localStorage.setItem('user', JSON.stringify(updatedUser));
      alert("Perfil atualizado com sucesso!");

      // Atualiza visual no menu
      if (userNameDisplay) userNameDisplay.textContent = updatedUser.name;
      if (userEmailDisplay) userEmailDisplay.textContent = updatedUser.email;
      if (userImageDisplay) userImageDisplay.src = updatedUser.profileImage;

      modal.style.display = "none";
    });
  }

  // Chama funções para carregar dados e configurar logout
  carregarDadosUsuario();
  configurarLogout();
  carregarFotoPerfil();
});
