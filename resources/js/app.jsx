import React from 'react'
import '../css/app.scss';
import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'

// ✅ Mettre à jour le manifest avec le code
function updateManifestWithCode(code) {
  const manifest = {
    name: "Cellarium",
    short_name: "CLM",
    background_color: "#FFFFFF",
    display: "standalone",
    description: "Une application de gestion de stock",
    theme_color: "#b00020",
    start_url: `/code/${code}`,  // ✅ Le code dans le start_url
    icons: [
      {
        src: "light_logo.png",
        sizes: "512x512",
        type: "image/png"
      }
    ]
  };
  
  const blob = new Blob([JSON.stringify(manifest)], { type: 'application/json' });
  const url = URL.createObjectURL(blob);
  const link = document.querySelector('link[rel="manifest"]');
  if (link) {
    link.href = url;
  }
}

// ✅ Sauvegarder et vérifier le code avant de lancer l'app
function handleAuthCode() {
  // Extraire le code de l'URL (ex: /code/925654)
  const pathMatch = window.location.pathname.match(/\/code\/([a-zA-Z0-9]+)/);
  const code = pathMatch ? pathMatch[1] : null;

  if (code) {
    // Si on a un code dans l'URL, le sauvegarder
    localStorage.setItem('userAuthCode', code);
    updateManifestWithCode(code); // ✅ Mettre à jour le manifest
    console.log('✅ Code sauvegardé et manifest mis à jour:', code);
  } 
  // else if (window.location.pathname === '/') {
  //   // Si on est à la racine sans code, vérifier localStorage
  //   const savedCode = localStorage.getItem('userAuthCode');
  //   if (savedCode) {
  //     console.log('🔄 Redirection vers le code sauvegardé:', savedCode);
  //     window.location.href = `/code/${savedCode}`;
  //     return false; // Arrêter le chargement
  //   }
  // }
  
  return true;
}

// Exécuter la vérification
if (handleAuthCode()) {
  createInertiaApp({
    resolve: name => resolvePageComponent(
      `./Pages/${name}.jsx`,
      import.meta.glob('./Pages/**/*.jsx', { eager: false })
    ),
    setup({ el, App, props }) {
      createRoot(el).render(<App {...props} />)
    },
  })
}