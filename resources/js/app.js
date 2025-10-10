import './bootstrap';
import 'bootstrap';
import Alpine from 'alpinejs';
import { initPe } from './pe.js';

window.Alpine = Alpine;

Alpine.start();

// Initialize Physical Examination functionality
// Will auto-run on DOMContentLoaded via pe.js
