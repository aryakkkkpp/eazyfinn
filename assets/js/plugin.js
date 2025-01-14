// Fungsi untuk menginisialisasi plugin
$(document).ready(function () {
  // jquery datatables
  $('#dataTable').DataTable();

  // tooltips
  $('[data-toggle="tooltip"]').tooltip();

  // datepicker
  $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  });
  
  // chosen select
  $('.chosen-select').chosen();

  // jquery mask plugin
  // format currency, menambahkan tanda titik (.)
  $('.mask-money').mask('0.000.000.000.000', {reverse: true});
  /* Documentation : https://igorescobar.github.io/jQuery-Mask-Plugin/docs.html */
});