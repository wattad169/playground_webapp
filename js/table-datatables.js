// INIT DATATABLES
$(function () {
	// Init
    var spinner = $( ".spinner" ).spinner();
    var table = $('#table_id').dataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );

    var tableTools = new $.fn.dataTable.TableTools( table, {
    	"sSwfPath": "../code/vendors/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
        "buttons": [
            "copy",
            "csv",
            "xls",
            "pdf",
            { "type": "print", "buttonText": "Print me!","hidden":"sda" }
        ]
    } );
    $(".DTTT_container").css("float","right");
});

