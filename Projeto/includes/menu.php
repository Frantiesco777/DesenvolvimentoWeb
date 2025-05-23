<header>
  <div class="menu-container">
    <nav class="navegacao">
      <div class="links-menu">

        <!-- Aba do usuário -->
        <div class="user-profile dropdown" id="userProfile">
          <div class="user-info" tabindex="0">
            <img src="" alt="Foto do usuário" id="userImage" class="user-image" />
            <span id="userName">Usuário</span>
          </div>
          <div class="submenu user-submenu">
            <p id="userEmail">email@usuario.com</p>
            <button id="logoutBtn">Logout</button>
            <button id="editProfileBtn">Editar perfil</button>
          </div>
        </div>

        <a href="http://localhost/Fran/DesenvolvimentoWeb/Projeto/site.php">Home</a>
        <a href="./generos/lancamentos.php">Lançamentos</a>    
        <a href="./generos/lancamentos.php">Assinatura</a>
        <div class="dropdown">
          <a href="#">Gênero</a>
          <div class="submenu">
            <a href="./generos/shounen.php">Shounen</a>
            <a href="./generos/comedia.php">Comédia</a>
            <a href="./generos/romance.php">Romance</a>
            <a href="./generos/seinein.php">Seinen</a>
            <a href="./generos/mecha.php">Mecha</a>
            <a href="./generos/terror.php">Terror</a>
            <a href="./generos/isekai.php">Isekai</a>
          </div>
        </div>
      </div>

      <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Buscar anime...">
        <button onclick="buscarAnime()">🔍</button>
      </div>
    </nav>
  </div>

  <!-- Janela de edição de perfil -->
  <div id="editProfileModal" class="modal" style="display: none;">
    <div class="modal-content">
      <span class="close" id="closeModalBtn">&times;</span>
      <h2>Editar Perfil</h2>
      <form id="editProfileForm">
        <label for="editName">Nome:</label>
        <input type="text" id="editName" name="editName" required><br><br>

        <label for="editEmail">Email:</label>
        <input type="email" id="editEmail" name="editEmail" required><br><br>

        <label for="editImage">Imagem de Perfil:</label>
        <input type="file" id="editImage" name="editImage" accept="image/*"><br><br>
        <img id="profileImagePreview" src="" alt="Prévia da imagem" style="max-width: 100px;"><br>

        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>
</header>
