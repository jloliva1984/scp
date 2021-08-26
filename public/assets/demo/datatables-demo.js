 

$(document).ready(function () {
  init();
  sampleTable = $('#dataTable').DataTable(mDefaultDataTableInstance);
});

function init() {
  mDefaultDataTableInstance = {
    responsive: true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "order": [[1, "desc"]],
    dom: 'Bfrtip',
    
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print',
    ],
  }
}