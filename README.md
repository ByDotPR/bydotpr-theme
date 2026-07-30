# By DOT PR — theme

Classic theme + bloques ACF Pro, optimizado para velocidad de carga (sin FSE, sin page builder).

## Requisitos
- WordPress 6.4+
- **Advanced Custom Fields PRO** activo (los bloques no funcionan sin él)
- PHP 8.0+

## Instalación
1. Copiar la carpeta `bydotpr/` a `wp-content/themes/`.
2. Activar ACF Pro.
3. Activar el theme "By DOT PR" en Apariencia > Temas.
4. Crear una página, asignarla como página de inicio estática (Ajustes > Lectura), y agregar los bloques en este orden desde el inserter (categoría "By DOT PR — Secciones"): Hero, About, Barra de clientes, Servicios, Por qué nosotros, RRSS, Formulario de contacto.
5. Configurar los menús "Menú principal" y "Menú de footer" en Apariencia > Menús.

## Pendientes antes de producción
- [ ] Reemplazar `assets/fonts/inter-var.woff2` por la tipografía real del PSD (self-hosted).
- [ ] Cargar los 14 logos de clientes, las imágenes/íconos de los 6 servicios y los bullets de "por qué nosotros" vía ACF.
- [ ] Confirmar campos finales del formulario de contacto (¿empresa sí/no?, ¿teléfono obligatorio?).
- [ ] Configurar el email destino del formulario en el campo ACF "Email destino" del bloque.
- [ ] Ajustar los valores exactos de `assets/css/main.css` (:root) con los tokens reales del PSD: colores, tipografía, espaciados.
- [ ] Exportar imágenes del PSD ya en los tamaños de `inc/setup.php` (`add_image_size`) para evitar que WP reescale de más.
- [ ] Correr Lighthouse/PageSpeed en cada bloque a medida que se agregan datos reales.

## Arquitectura
- Cada sección del wireframe = un bloque ACF independiente en `/blocks/{nombre}/` con su propio `block.json`, template PHP y `style.css` (se encola solo si el bloque está en la página — ver `bydotpr_enqueue_block_asset()` en `inc/assets.php`).
- Los campos de cada bloque están definidos por código en `inc/acf-fields.php` (no dependen de exportar/importar JSON de ACF).
- El formulario de contacto usa un handler AJAX propio (`inc/contact-handler.php`) en vez de un plugin de formularios, para minimizar peso.
