import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/style.css",
                "resources/css/homepage.css",
                "resources/css/contact.css",
                "resources/css/daftar.css",
                "resources/css/jadwalkelas.css",
                "resources/css/login.css",
                "resources/css/mentor.css",
                "resources/css/payment.css",
                "resources/css/register.css",
                "resources/css/staff.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
