// JS global del theme. Mantener vacío/mínimo a propósito:
// cada bloque que necesite JS carga el suyo propio (ver blocks/contact-form/form.js)
// para no meter código sin usar en páginas que no tienen ese bloque.

document.addEventListener('DOMContentLoaded', function () {
	// Toggle del menú mobile (el header lo trae inline via data-attrs, ver header.php).
	var toggle = document.querySelector('[data-menu-toggle]');
	var menu = document.querySelector('[data-menu]');
	if (toggle && menu) {
		toggle.addEventListener('click', function () {
			var isOpen = menu.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}
});
