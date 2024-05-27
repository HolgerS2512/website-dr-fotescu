(() => {
  const allAitem = document.querySelectorAll('[title]');

  const init = () => {
      allAitem.forEach((aEl) => aEl.addEventListener('mouseover', rmAttrTitle));
      allAitem.forEach((aEl) => aEl.addEventListener('mouseleave', setAttrTitle));
  }

  const rmAttrTitle = (e) => {
      const el = e.currentTarget;

      if (el.hasAttribute('title') && el.title.length >=1) {
          el.setAttribute('data-title', el.title);
          el.title = '';
      }
  }

  const setAttrTitle = (e) => {
      const el = e.currentTarget;

      if (el.hasAttribute('data-title')) {
          el.title = el.dataset.title;
          el.removeAttribute('data-title');
      }
  }

  init();
})()