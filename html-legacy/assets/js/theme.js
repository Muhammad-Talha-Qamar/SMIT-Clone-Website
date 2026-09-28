(function () {
  var STORAGE_KEY = 'smit-theme';

  function getTheme() {
    try {
      return localStorage.getItem(STORAGE_KEY) === 'dark' ? 'dark' : 'light';
    } catch (e) {
      return 'light';
    }
  }

  function applyTheme(theme) {
    var isDark = theme === 'dark';
    document.documentElement.classList.toggle('theme-dark', isDark);
    document.documentElement.setAttribute('data-theme', theme);
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {}

    var btn = document.getElementById('theme-toggle');
    if (btn) {
      btn.setAttribute('aria-pressed', isDark ? 'true' : 'false');
      btn.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
      btn.title = isDark ? 'Light mode' : 'Dark mode';
    }
  }

  function toggleTheme() {
    applyTheme(getTheme() === 'dark' ? 'light' : 'dark');
  }

  window.smitTheme = {
    get: getTheme,
    apply: applyTheme,
    toggle: toggleTheme
  };

  applyTheme(getTheme());

  document.addEventListener('click', function (event) {
    var btn = event.target.closest ? event.target.closest('#theme-toggle') : null;
    if (!btn) return;
    event.preventDefault();
    if (event.target.closest('.theme-toggle__option--light')) {
      applyTheme('light');
      return;
    }
    if (event.target.closest('.theme-toggle__option--dark')) {
      applyTheme('dark');
      return;
    }
    toggleTheme();
  });
})();
