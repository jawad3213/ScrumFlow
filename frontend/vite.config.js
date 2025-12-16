import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

// https://vite.dev/config/
export default defineConfig({
   test: {
    // options de configuration de vitest
    environment: 'jsdom',
    globals: true, // pour utiliser les fonctions expect, describe, etc. sans les importer
    include: ['src/tests/**/*.{test,spec}.{js,mjs,cjs,ts,mts,cts,jsx,tsx}'],
  },
  plugins: [react()],
  
})
