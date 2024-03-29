// vite.config.js
import { defineConfig } from "file:///C:/MAMP/htdocs/boolbnb-team-5/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/MAMP/htdocs/boolbnb-team-5/node_modules/laravel-vite-plugin/dist/index.js";
import path from "path";
var __vite_injected_original_dirname = "C:\\MAMP\\htdocs\\boolbnb-team-5";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/scss/app.scss",
        "resources/scss/variables.scss",
        "resources/scss/sponsors/sponsors.scss",
        "resources/scss/apartments/apartments.scss",
        "resources/scss/apartments/show.scss",
        "resources/scss/services/index.scss",
        "resources/js/app.js"
      ],
      refresh: true
    })
  ],
  resolve: {
    alias: {
      "~resources": "/resources/",
      "~bootstrap": path.resolve(__vite_injected_original_dirname, "node_modules/bootstrap")
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxNQU1QXFxcXGh0ZG9jc1xcXFxib29sYm5iLXRlYW0tNVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxcTUFNUFxcXFxodGRvY3NcXFxcYm9vbGJuYi10ZWFtLTVcXFxcdml0ZS5jb25maWcuanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L01BTVAvaHRkb2NzL2Jvb2xibmItdGVhbS01L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcblxuaW1wb3J0IHBhdGggZnJvbSAncGF0aCc7XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9zY3NzL2FwcC5zY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL3Njc3MvdmFyaWFibGVzLnNjc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvc2Nzcy9zcG9uc29ycy9zcG9uc29ycy5zY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL3Njc3MvYXBhcnRtZW50cy9hcGFydG1lbnRzLnNjc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvc2Nzcy9hcGFydG1lbnRzL3Nob3cuc2NzcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9zY3NzL3NlcnZpY2VzL2luZGV4LnNjc3MnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgICAgIF0sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICBdLFxuICAgIHJlc29sdmU6IHtcbiAgICAgICAgYWxpYXM6IHtcbiAgICAgICAgICAgICd+cmVzb3VyY2VzJzogJy9yZXNvdXJjZXMvJyxcbiAgICAgICAgICAgICd+Ym9vdHN0cmFwJzogcGF0aC5yZXNvbHZlKF9fZGlybmFtZSwgJ25vZGVfbW9kdWxlcy9ib290c3RyYXAnKSxcbiAgICAgICAgfVxuICAgIH0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBaVIsU0FBUyxvQkFBb0I7QUFDOVMsT0FBTyxhQUFhO0FBRXBCLE9BQU8sVUFBVTtBQUhqQixJQUFNLG1DQUFtQztBQUt6QyxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUEsUUFDSDtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLE1BQ0o7QUFBQSxNQUNBLFNBQVM7QUFBQSxJQUNiLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFDQSxTQUFTO0FBQUEsSUFDTCxPQUFPO0FBQUEsTUFDSCxjQUFjO0FBQUEsTUFDZCxjQUFjLEtBQUssUUFBUSxrQ0FBVyx3QkFBd0I7QUFBQSxJQUNsRTtBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
