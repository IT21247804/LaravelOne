import './bootstrap';

import Alpine from 'alpinejs';
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './components/App'; // Ensure this matches the filename

window.Alpine = Alpine;

Alpine.start();

const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<App />);
