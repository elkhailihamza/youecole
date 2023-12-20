// Call the dataTables jQuery plugin
$(document).ready(function () {
  var initialPageLength = $('#dataTable').find('tbody tr').length;

    $('#dataTable').DataTable({
        "lengthMenu": [[initialPageLength], [initialPageLength]]
    });
});
