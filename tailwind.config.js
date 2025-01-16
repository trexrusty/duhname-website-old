/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          'primary': '#000000',
          'secondary': '#121212',
          'tertiary': '#242424',
          'quaternary': '#363636',
          'verified': '#39f566',
          'bugfinder': '#fdba14',
        },
      },
    },
    plugins: [],
  }
