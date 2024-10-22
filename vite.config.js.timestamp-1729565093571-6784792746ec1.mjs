// vite.config.js
import { defineConfig } from "file:///Users/joannaavalos/SitesLaravel/klwebapp/node_modules/vite/dist/node/index.js";
import laravel from "file:///Users/joannaavalos/SitesLaravel/klwebapp/node_modules/laravel-vite-plugin/dist/index.js";
import fs from "fs";
var keyPath = process.env.VITE_KEY_PATH || "";
var certPath = process.env.VITE_CERT_PATH || "";
var host = process.env.VITE_HOST || "localhost";
if (!keyPath || !certPath) {
  console.error("ERROR: Missing SSL certificate paths in environment variables");
  process.exit(1);
}
var vite_config_default = defineConfig({
  server: {
    https: {
      key: fs.readFileSync(keyPath),
      cert: fs.readFileSync(certPath)
    },
    host,
    hmr: {
      host
    }
  },
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true
    })
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCIvVXNlcnMvam9hbm5hYXZhbG9zL1NpdGVzTGFyYXZlbC9rbHdlYmFwcFwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiL1VzZXJzL2pvYW5uYWF2YWxvcy9TaXRlc0xhcmF2ZWwva2x3ZWJhcHAvdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL1VzZXJzL2pvYW5uYWF2YWxvcy9TaXRlc0xhcmF2ZWwva2x3ZWJhcHAvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBkZWZpbmVDb25maWcgfSBmcm9tICd2aXRlJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IGZzIGZyb20gJ2ZzJztcblxuLy8gVmVyaWZpY2FyIHNpIGxhcyB2YXJpYWJsZXMgZGUgZW50b3JubyBleGlzdGVuXG5jb25zdCBrZXlQYXRoID0gcHJvY2Vzcy5lbnYuVklURV9LRVlfUEFUSCB8fCAnJztcbmNvbnN0IGNlcnRQYXRoID0gcHJvY2Vzcy5lbnYuVklURV9DRVJUX1BBVEggfHwgJyc7XG5jb25zdCBob3N0ID0gcHJvY2Vzcy5lbnYuVklURV9IT1NUIHx8ICdsb2NhbGhvc3QnO1xuXG5pZiAoIWtleVBhdGggfHwgIWNlcnRQYXRoKSB7XG4gICAgY29uc29sZS5lcnJvcignRVJST1I6IE1pc3NpbmcgU1NMIGNlcnRpZmljYXRlIHBhdGhzIGluIGVudmlyb25tZW50IHZhcmlhYmxlcycpO1xuICAgIHByb2Nlc3MuZXhpdCgxKTsgLy8gVGVybWluYXIgZWwgcHJvY2VzbyBzaSBubyBlc3RcdTAwRTFuIGRlZmluaWRhc1xufVxuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHNlcnZlcjoge1xuICAgICAgICBodHRwczoge1xuICAgICAgICAgICAga2V5OiBmcy5yZWFkRmlsZVN5bmMoa2V5UGF0aCksXG4gICAgICAgICAgICBjZXJ0OiBmcy5yZWFkRmlsZVN5bmMoY2VydFBhdGgpLFxuICAgICAgICB9LFxuICAgICAgICBob3N0OiBob3N0LFxuICAgICAgICBobXI6IHtcbiAgICAgICAgICAgIGhvc3Q6IGhvc3QsXG4gICAgICAgIH0sXG4gICAgfSxcbiAgICBwbHVnaW5zOiBbXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFsncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJywgJ3Jlc291cmNlcy9qcy9hcHAuanMnXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgIF0sXG59KTtcblxuLy8gaW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG4vLyBpbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcblxuLy8gZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcbi8vICAgICBwbHVnaW5zOiBbXG4vLyAgICAgICAgIGxhcmF2ZWwoe1xuLy8gICAgICAgICAgICAgaW5wdXQ6IFtcbi8vICAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJyxcbi8vICAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2pzL2FwcC5qcycsXG4vLyAgICAgICAgICAgICBdLFxuLy8gICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbi8vICAgICAgICAgfSksXG4vLyAgICAgXSxcbi8vIH0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUE2UyxTQUFTLG9CQUFvQjtBQUMxVSxPQUFPLGFBQWE7QUFDcEIsT0FBTyxRQUFRO0FBR2YsSUFBTSxVQUFVLFFBQVEsSUFBSSxpQkFBaUI7QUFDN0MsSUFBTSxXQUFXLFFBQVEsSUFBSSxrQkFBa0I7QUFDL0MsSUFBTSxPQUFPLFFBQVEsSUFBSSxhQUFhO0FBRXRDLElBQUksQ0FBQyxXQUFXLENBQUMsVUFBVTtBQUN2QixVQUFRLE1BQU0sK0RBQStEO0FBQzdFLFVBQVEsS0FBSyxDQUFDO0FBQ2xCO0FBRUEsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsUUFBUTtBQUFBLElBQ0osT0FBTztBQUFBLE1BQ0gsS0FBSyxHQUFHLGFBQWEsT0FBTztBQUFBLE1BQzVCLE1BQU0sR0FBRyxhQUFhLFFBQVE7QUFBQSxJQUNsQztBQUFBLElBQ0E7QUFBQSxJQUNBLEtBQUs7QUFBQSxNQUNEO0FBQUEsSUFDSjtBQUFBLEVBQ0o7QUFBQSxFQUNBLFNBQVM7QUFBQSxJQUNMLFFBQVE7QUFBQSxNQUNKLE9BQU8sQ0FBQyx5QkFBeUIscUJBQXFCO0FBQUEsTUFDdEQsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLEVBQ0w7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
