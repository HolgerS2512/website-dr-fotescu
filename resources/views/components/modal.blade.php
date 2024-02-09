<section id="status-msg" class="modal vis-modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content shadow bg-body-tertiary">
      <div class="modal-header border-bottom-0">
        <button 
          type="button" 
          class="btn-close" 
          data-bs-dismiss="modal" 
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body text-center">
        <p class="modal-title pb-5">{{ $message }}</p>
        <div class="modal-bar fade-timeout {{ $status ? 'status-1' : 'status-0' }}"></div>
      </div>
    </div>
  </div>
</section>

<script>
  (() => {
    const statusModalEl = document.querySelector('#status-msg');
    const statusBarEl = statusModalEl.querySelector('.modal-bar');
    const closeBtn = statusModalEl.querySelector('.btn-close');

    const init = () => {
      rmModal(calcModalWidth());
      closeBtn.addEventListener('click', rmModalClass);
    }

    const calcModalWidth = () => Number((window.getComputedStyle(statusBarEl).width).replace('px', ''));

    const rmModal = (value) => {
      setTimeout(() => {
        (value === 0) ? rmModalClass() : rmModal(calcModalWidth());
      }, 200);
    }

    const rmModalClass = () => {
      statusModalEl.classList.remove('vis-modal');
      setTimeout(() => {
        statusModalEl.style.display = 'none';
      }, 500);
    }

    init();
  })();
</script>