
// Ajax para a página de relatórios de entrada 
$(document).ready(function() {

    $("input").keyup(function() {

        var table_origin = document.getElementById("table_report_entry");
        table_origin.style.display = "none";
        
        var name_search_entry = $("#name_search_entry").val();
        var values_entry = $("#values_entry").val();
        var from_date_entry = $("#from_date_entry").val();
        var to_date_entry = $("#to_date_entry").val();
        var category_entry = $("#category_entry").val();
        var user_id = $("#user_id").val();

        $.post("financial_entry_ajax.php", {
            name_search_entry: name_search_entry,
            values_entry: values_entry,
            from_date_entry: from_date_entry,
            to_date_entry: to_date_entry,
            category_entry: category_entry,
            user_id: user_id
        }, function(data, status) {
            $("#search_entry").html(data);
        });
    });

    $("#values_entry").on("click", function(){
        var values_entry = $("#values_entry").val();
        var name_search_entry = $("#name_search_entry").val();
        var from_date_entry = $("#from_date_entry").val();
        var to_date_entry = $("#to_date_entry").val();
        var category_entry = $("#category_entry").val();
        var user_id = $("#user_id").val();
        var table_origin = document.getElementById("table_report_entry");
        table_origin.style.display = "none";
        
        $.post("financial_entry_ajax.php", {
            values_entry: values_entry,
            name_search_entry: name_search_entry,
            from_date_entry: from_date_entry,
            to_date_entry: to_date_entry,
            category_entry: category_entry,
            user_id: user_id
        }, function(data, status) {
            $("#search_entry").html(data);
        });
    });

    $("#category_entry").on("click", function(){
        var values_entry = $("#values_entry").val();
        var name_search_entry = $("#name_search_entry").val();
        var from_date_entry = $("#from_date_entry").val();
        var to_date_entry = $("#to_date_entry").val();
        var category_entry = $("#category_entry").val();
        var user_id = $("#user_id").val();
        var table_origin = document.getElementById("table_report_entry");
        table_origin.style.display = "none";
        
        $.post("financial_entry_ajax.php", {
            values_entry: values_entry,
            name_search_entry: name_search_entry,
            from_date_entry: from_date_entry,
            to_date_entry: to_date_entry,
            category_entry: category_entry,
            user_id: user_id
        }, function(data, status) {
            $("#search_entry").html(data);
        });
    });
});
// Fim Ajax para a página de relatórios de entrada 