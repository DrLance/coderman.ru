module.exports = {
  theme: {
    fontSize: {
      'xs': '.75rem',
      '13p': '0.8125rem',
      'sm': '.875rem',
      'tiny': '.875rem',
      'base': '1rem',
      'lg': '1.125rem',
      'xl': '1.25rem',
      '2xl': '1.5rem',
      '3xl': '1.875rem',
      '4xl': '2.25rem',
      '5xl': '3rem',
      '6xl': '4rem',
      '7xl': '5rem',
    },
    colors: {
      content: '#86939e',
      heading: '#606676',
      dark: '#202e78',
      border: '#e1e8ee',
      blue: '#03a9f4'
    },
    container: {
      'max-width': '1140px'
    },
    extend: {},
  },
  variants: {
    tableLayout: ['responsive', 'hover', 'focus'],
  },
  plugins: [
    require( 'tailwindcss-animatecss' )( ['responsive'] )
  ]
};
