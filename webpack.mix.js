const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .copy(
        "node_modules/sweetalert2/dist/sweetalert2.min.js",
        "public/js/sweetalert2.min.js"
    )
    .copy(
        "node_modules/sweetalert2/dist/sweetalert2.min.css",
        "public/css/sweetalert2.min.css"
    )
    .sourceMaps();
