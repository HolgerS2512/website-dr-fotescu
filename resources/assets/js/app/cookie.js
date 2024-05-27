(() => {
  'use strict';
  const cookie = document.querySelector('.cookie');
  const acceptCoo = document.querySelector('#cookie-accept');
  const rejectCoo = document.querySelector('#cookie-reject');

  const init = () => {
    acceptCoo.addEventListener('click', cookieSettings);
    rejectCoo.addEventListener('click', cookieFadeOut);
  }

  const cookieSettings = () => {
    const expires = new Date();
    const date = expires.getTime() + (3 * 30 * 24 * 60 * 60 * 1000);
    expires.setTime(date);
    document.cookie = `Cookie=true; expires=${expires.toGMTString()}; samesite=strict; path=/; secure`;
    cookieFadeOut();
  }

  const cookieFadeOut = () => {
    cookie.classList.add('fadeOut');
    setTimeout(() => cookie.style.display = 'none', 1200);
  }

  init();
})()