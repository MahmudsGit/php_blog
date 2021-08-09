function string_to_slug(text) {
    $("#catagory_slug").val(text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,''));
}
$(document).ready(function() {
    $('#dataTable').DataTable();
});
