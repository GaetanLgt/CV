/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#02080A',
        secondary: '#04131B',
        accent: '#00ff41',
        'accent-soft': '#7CFFA8',
        // MND — signature GL (2026-10) : noir profond + émeraude
        mnd: '#00ff41',
        'mnd-dark': '#00cc34',
        'mnd-light': '#7CFFA8',
        'mnd-glow': 'rgba(0, 255, 65, 0.4)',
        'ink': '#02080A',
        'ink-2': '#04131B',
        'ink-border': '#0E3B33',
      },
      fontFamily: {
        sans: ['Space Grotesk', 'system-ui', 'sans-serif'],
        display: ['Fraunces', 'Georgia', 'serif'],
      },
    },
  },
  plugins: [],
}
