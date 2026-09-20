tailwind.config = {
  corePlugins: {
    preflight: document.documentElement.getAttribute('data-legacy-css') !== 'true',
  },
  theme: {
    extend: {
      fontFamily: {
        montserrat: ['Montserrat', 'sans-serif'],
      },
      colors: {
        brand: {
          blue: '#007bff',
          primary: '#0b73b7',
          sky: '#1370b8',
          green: '#6da800',
          mega: '#087fc3',
        },
      },
    },
  },
};
