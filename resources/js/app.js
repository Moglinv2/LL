import './bootstrap';
import '../css/app.scss';
import * as bootstrap from 'bootstrap'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({
                methods: {
                    pad(number) {
                        return ("0" + number).slice(-2);
                    },
                    currency(amount) {
                        const formatter = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' })
                        return formatter.format(amount);
                    },
                    dateFormat(date) {
                        const d = new Date(date);
                        return `${d.getDay()}/${d.getMonth()}/${d.getFullYear()}`;
                    },
                    copy(text) {
                        var input = document.createElement('input');
                        input.setAttribute('value', text);
                        document.body.appendChild(input);
                        input.select();
                        var result = document.execCommand('copy');
                        document.body.removeChild(input);
                        return result;
                    }
                }
            })
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
