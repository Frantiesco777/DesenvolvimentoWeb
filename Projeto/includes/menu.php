
<header>
      <div class="menu-container">
        <nav class="navegacao">
          <div class="links-menu">
            <button id="logoutBtn">Logout</button>
            <a href="http://localhost/Fran/DesenvolvimentoWeb/Projeto/site.php">Home</a>
            <a href="./generos/lancamentos.php">Lançamentos</a>    
            <a href="./generos/lancamentos.html">Assinatura</a>
            <div class="dropdown">
              <a href="#">Gênero</a>
              <div class="submenu">
                <a href="./generos/shounen.html">Shounen</a>
                <a href="./generos/comedia.html">Comédia</a>
                <a href="./generos/romance.html">Romance</a>
                <a href="./generos/seinein.html">Seinen</a>
                <a href="./generos/mecha.html">Mecha</a>
                <a href="./generos/terror.html">Terror</a>
                <a href="./generos/isekai.html">Isekai</a>
              </div>
            </div>
          </div>
    
          <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Buscar anime...">
            <button onclick="buscarAnime()">🔍</button>
          </div>
        </nav>
      </div>
    </header>