function populate_dropdown(ajaxUrl,element,columnValue,columnText){
    $.ajax({
        url: ajaxUrl,
        type: "GET",
        dataType: 'JSON',
        success: function(result){
            $data = result.data;
            $.each($data, function() {
                $(element).append($("<option />").val(this[columnValue]).text(this[columnText]));
            });
            
        }
    })
}

function populate_dropdown_subTable(ajaxUrl,$element,columnValue,columnText){
    $.ajax({
        url: ajaxUrl,
        type: "GET",
        dataType: 'JSON',
        success: function(result){
            $data = result.data;
            $.each($data, function() {
                $element.append($("<option />").val(this[columnValue]).text(this[columnText]));
            });
            
        }
    })
}

function generateTable($element,ajaxUrl,ajaxType,ajaxData,_columns,groupKey){
    if($.fn.DataTable.isDataTable( $element )){
        $($element).DataTable().destroy();
    }

    $($element).DataTable({
        ajax: {
            url : ajaxUrl,
            type : ajaxType,
            data: ajaxData
        },
        columns: _columns,
        select: {
            style: 'multi'
        }
    })
}