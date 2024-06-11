import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import { OhVueIcon, addIcons } from "oh-vue-icons";
import * as FaIcons from "oh-vue-icons/icons/fa";
import * as BiIcons from "oh-vue-icons/icons/bi";
import * as CoIcons from "oh-vue-icons/icons/co";

const Fa = Object.values({ ...FaIcons });
const Bi = Object.values({ ...BiIcons});
const Co = Object.values({ ...CoIcons});

addIcons(...Fa);
addIcons(...Bi);
addIcons(...Co);

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(OhVueIcon, { addIcons })
            .component("v-icon", OhVueIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
