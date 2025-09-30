import './bootstrap';

// Import Bootstrap CSS and JS
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

/**
 * Load jQuery plugins AFTER jQuery has been initialized in bootstrap.js
 */
import 'jquery-ui-dist/jquery-ui';
import 'datatables.net';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
