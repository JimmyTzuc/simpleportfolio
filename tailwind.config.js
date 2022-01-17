const colors = require('tailwindcss/colors')

module.exports = {
darkMode: 'media',
  corePlugins: {
   padding: true,
  },
  theme: {
    colors: {
      gray: colors.coolGray,
      blue: colors.lightBlue,
      red: colors.rose,
      pink: colors.fuchsia,
      emerald: colors.emerald,
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  },
  variants: {
      transitionProperty: ['responsive', 'motion-safe', 'motion-reduce'],
    extend: {
      borderColor: ['focus-visible'],
      opacity: ['disabled'],
    }
  }
}