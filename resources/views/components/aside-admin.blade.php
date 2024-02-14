<div id="admin-bar" class="text-bg-dark h-100">
  <div class="d-none-992 py-3">
    <h2 class="ms-2">Pages</h2>
    <button id="aside-nav" type="button" class="btn btn-primary px-3">
      <svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 -960 960 960" width="26"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" Fill="#FFF" /></svg>
    </button>
  </div>

  <div class="accordion accordion-flush" id="aside-bar">
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Home
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
        <div class="accordion-body">Placeholder</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
          Blog
        </button>
      </h2>
      <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
        <div class="accordion-body">Placeholder</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
          Praxis & Team
        </button>
      </h2>
      <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
        <div class="accordion-body">Placeholder</div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
          Kontakt
        </button>
      </h2>
      <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#aside-bar">
        <div class="accordion-body">Placeholder</div>
      </div>
    </div>
  </div>
</div>

<script>
  (() => {
    const asideMenuBtn = document.querySelector('#aside-nav');
    const asideNavbar = document.querySelector('#admin-bar');

    const init = () => {
      checkStorage();
      asideMenuBtn.addEventListener('click', toggleMenu);
    }

    const checkStorage = () => {
      const store = localStorage.getItem("adminBar");

      if (store !== null && Boolean(store)) {
        asideNavbar.classList.add('close-bar');
        localStorage.setItem("adminBar", true);
      }
    }

    const toggleMenu = () => {
      const position = getComputedStyle(asideNavbar).getPropertyValue('left');
      const quest = Number(position.substring(0, position.length - 2)) === 0;
      const quest2 = asideNavbar.classList.contains('close-bar');

      if (quest && !quest2) {
        asideNavbar.classList.add('close-bar');
        localStorage.setItem("adminBar", true);
      } else {
        asideNavbar.classList.remove('close-bar');
        localStorage.removeItem("adminBar");
      }
    }

    init();
  })()
</script>