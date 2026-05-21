import React from 'react'
import '../css/app.scss';
import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

createInertiaApp({
    resolve: name => resolvePageComponent(
        `./Pages/${name}.jsx`,
        import.meta.glob('./Pages/**/*.jsx', { eager: false })
    ),
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />)
    },
})
