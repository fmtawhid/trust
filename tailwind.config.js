/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/css/**/*.css",
        "./resources/**/*.vue",
    ],
    // content: ["./src/**/*.{html,js}"],
    darkMode: "class",
    theme: {
        screens: {
            sm: "600px",
            // => @media (min-width: 600px) { ... }

            md: "768px",
            // => @media (min-width: 768px) { ... }

            lg: "1024px",
            // => @media (min-width: 1024px) { ... }

            xl: "1280px",
            // => @media (min-width: 1280px) { ... }

            "2xl": "1536px",
            // => @media (min-width: 1536px) { ... }

            "3xl": "1680px",
            // => @media (min-width: 1600px) { ... }
            "4xl": "1700px",
            // => @media (min-width: 1600px) { ... }
        },
        extend: {
            fontFamily: {
                outfit: ["Outfit", "sans-serif"],
                inter: ["Inter", "sans-serif"],
                ptSerif: ["PT Serif", "serif"],
                Roboto: ["Roboto", "sans-serif"],
            },
            fontSize: {
                "3.5xl": [
                    "2rem",
                    {
                        lineHeight: "2.5rem",
                        fontWeight: "500",
                    },
                ],
            },
            colors: {
                brand: {
                    primary: "#F65050",
                    secondary: "#00427A",
                },
                theme: {
                    one: "#F65050",
                    two: "#BF000F",
                    three: "#003366",
                    four: "#0A1633",
                    five: {
                        primary: "#010F83",
                        secondary: "#141A2A",
                        tertiary: "#040C48",
                        // quaternary: "#FBF5EF",
                    },
                    six: {
                        primary: "#A0436A",
                        secondary: "#34132A",
                        tertiary: "#FFFAF5",
                        quaternary: "#FBF5EF",
                    },
                },

                gray: {
                    // primary: "#ababab",
                    // secondary: "#404040",
                    // tertiary: "#f5f5f5",
                    // quaternary: "#fafafa",
                },

                light: {
                    primary: "#f0f0f0",
                },
                social: {
                    facebook: "#1B7BFD",
                    twitter: "#42C0F5",
                    instragram: "#C23785",
                    youtube: "#EF5043",
                    linkedin: "#00a0dc",
                    dribble: "#F7679D",
                },
            },
            zIndex: {
                999999: "999999",
                99999: "99999",
                9999: "9999",
                999: "999",
                99: "99",
                9: "9",
                1: "1",
            },

            animation: {
                movingLine: "movingLine 2.4s infinite ease-in-out",
                moveLetters: "moveLetters 2.4s infinite ease-in-out",
            },
            keyframes: {
                movingLine: {
                    "0%, 100%": {
                        opacity: 0,
                        width: 0,
                    },
                    "33.3%, 66%": {
                        opacity: 0.8,
                        width: "100%",
                    },
                    "85%": {
                        width: 0,
                        left: "initial",
                        right: 0,
                        opacity: 1,
                    },
                },
                moveLetters: {
                    "0%": {
                        transform: "translateX(-15vw)",
                        opacity: 0,
                    },
                    "33.3%, 66%": {
                        transform: "translateX(0)",
                        opacity: 1,
                    },
                    "100%": {
                        transform: "translateX(15vw)",
                        opacity: 0,
                    },
                },
            },
            dropShadow: {
                black_sm: "0px 2px 10px var(--black-shadow)",
            },
            boxShadow: {
                small: "0px 1px 2px 0px var(--tw-shadow-color-1), 0px 2px 6px 2px var(--tw-shadow-color-2)",
            },
        },
    },
    plugins: [],
};
