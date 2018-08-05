const $ = require('jquery');
require('bootstrap');
require('./app.scss');

require('popper.js');
require('@fortawesome/fontawesome-free');
require('@fortawesome/fontawesome-free/css/all.min.css');

require('./css/main.min.css');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});