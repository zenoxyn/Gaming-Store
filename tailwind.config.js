/** @type {import('tailwindcss').Config} */
export default {
  content: ["./html/**/*.{html,php}", "./js/**/*.js"],
  theme: {
    extend: {
      fontFamily: {
        Jost: ["Jost", "sans-serif"],
        Lobster: ["Lobster", "sans-serif"],
      },
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
