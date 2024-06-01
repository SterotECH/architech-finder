/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: require('fast-glob').sync([
        'resources/**/*.{blade.php,blade.md,md,html,vue,php}',
        'app/**/*.php',
        '!resources/**/_tmp/*'
    ], {dot: true}),
    theme: {
        extend: {
            keyframes: {
                'fade-slide-up-in': {
                    from: {
                        opacity: 0,
                        transform: 'translateY(15%)'
                    },
                    to: {
                        opacity: 1,
                        transform: 'translateY(0%)'
                    }
                },
                'buttonGradient':{
                    0: {
                        'background-position': '0% 0%'
                    },
                    15: {
                        'background-position': '33% 0%'
                    },
                    90: {
                        'background-position': '80% 0%'
                    },
                    100: {
                        'background-position': '100% 0%'
                    }
                },
                'clip-path-circle-open': {
                    from: {
                        opacity: 0,
                        transform: 'translateY(15%)'
                    },
                    to: {
                        opacity: 1,
                        transform: 'translateY(0%)'
                    }
                },
                'clip-path-circle-close': {
                    from: {
                        opacity: 1,
                        transform: 'translateY(0%)'
                    },
                    to: {
                        opacity: 0,
                        transform: 'translateY(15%)'
                    }
                },
            },
            animation: {
                'fade-slide-up-in': 'fade-slide-up-in 0.5s ease-out',
                'buttonGradient': 'buttonGradient 3s linear infinite',
                'clip-path-circle-open': 'clip-path-circle-open 0.5s ease-out',
                'clip-path-circle-close': 'clip-path-circle-close 0.5s ease-out',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui'),
    ],
    daisyui: {
        themes: ['winter'],
    }
};
