/** @type {import('tailwindcss').Config} */
export default {
  content: ["./html/**/*.{html,php}", "./js/**/*.js"],
  theme: {
    extend: {
      colors: {
        primary: '#8a2be2',      // Purple
        secondary: '#ff1493',    // Pink
        dark: '#1a0b2e',         // Dark purple
        darkPurple: '#2d1b4e',   // Medium purple
      }
    },
    container: {
      center: true,
      padding: {
        DEFAULT: "12px",
        sm: "16px",
        lg: "24px",
        xl: "32px",
        "2xl": "40px",
      },
    },
  },
  plugins: [],
};