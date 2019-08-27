module.exports = {
  theme: {
    extend: {}
  },
  variants: {
    tableLayout: ['responsive', 'hover', 'focus'],
  },
  plugins: [
    require('tailwindcss-animatecss')(['responsive'])
  ]
};
