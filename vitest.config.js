import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  test: {
    globals: true,
    environment: 'jsdom',
    setupFiles: './setupTests.js',
    include: ['resources/js/**/*.test.{js,jsx}'],
    coverage: {
      include: ['resources/js/**/*.{js,jsx}']
    },
    environmentOptions: {
      jsdom: {
        url: 'https://jobboard.test',
      }
    },
  },
});