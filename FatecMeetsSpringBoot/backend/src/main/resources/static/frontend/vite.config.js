// FatecMeetsSpringBoot/frontend/vite.config.js

import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

const backendUrl =
  process.env.VITE_API_URL || "http://backend:8080";

export default defineConfig({
  plugins: [react()],
  server: {
    host: "0.0.0.0",
    port: 5173,
    strictPort: true,
    proxy: {
      "/api": {
        target: backendUrl,
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/api/, ""),
      },
    },
  },
});
