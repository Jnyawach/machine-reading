import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import axios from "axios";
axios.defaults.baseURL=import.meta.env.VITE_APP_URL;
import '../css/main.css'
import 'flowbite';



createInertiaApp({
    resolve: (name) => resolvePageComponent(`../views/pages/${name}.vue`, import.meta.glob('../views/pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route: window.route } })
            .mount(el)
    },
    title: title => `${title} | Machine Reading`,
    progress: {
        // The delay after which the progress bar will appear
        // during navigation, in milliseconds.
        delay: 250,

        // The color of the progress bar.
        color: '#29d',

        // Whether to include the default NProgress styles.
        includeCSS: true,

        // Whether the NProgress spinner will be shown.
        showSpinner: false,
    },
});
