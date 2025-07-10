import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});




 /*
= App\Models\Usuario {#5166
    nombre: "admin",
    #contraseña: "$2y$12$I3R0pFJU0ngeMz3ARoFINuq9O4Ijbx8FFtC4vsYV/KTpRv34yeIvm",
    rol: "admin",
    updated_at: "2025-07-02 05:21:04",
    created_at: "2025-07-02 05:21:04",
    id: 1,
  }

>
> \App\Models\Usuario::create([
.     'nombre' => 'juan',
.     'contraseña' => bcrypt('usuario123'),
.     'rol' => 'usuario'
= App\Models\Usuario {#5202
    nombre: "juan",
    #contraseña: "$2y$12$KXCtIeLbFQOekPUW3tvpvuRN0P.n1G6k56Kdiu8lbgUXS8cZrQVQO",
    rol: "usuario",
    id: 2,
*/