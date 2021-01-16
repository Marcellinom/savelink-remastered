require('./bootstrap');
require('https://code.jquery.com/jquery-3.5.1.js');
require('https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js');
require('https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js');
require('https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js');
$(document).ready(function() {
    var table = $('#tabel').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );
