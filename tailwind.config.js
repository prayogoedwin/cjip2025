/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'
export default {
  darkMode: 'class',
  content: [
    './app/Filament/**/*.php',
    './app/Livewire/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
    "./resources/**/*.blade.php",
    'node_modules/preline/dist/*.js',
    './src/**/*.{html,js}',
    './vendor/kenepa/banner/resources/**/*.php',
  ],

  theme: {
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      },
        animation: {
            typing: 'typing 2s steps(6), blink 1s infinite',
        },
        keyframes: {
            typing: {
                from: {
                    width: '0'
                },
                to: {
                    width: '6ch'
                },
            },
            blink: {
                from: {
                    'border-right-color': 'transparent'
                },
                to: {
                    'border-right-color': 'black'
                },
            },
        },
        fontFamily: {
            satoshi: ['Satoshi', 'sans-serif'],
            inter: ['Inter', 'sans-serif'],
        },
        colors: {
            'primary-orange': '#FF5722',
        },
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

