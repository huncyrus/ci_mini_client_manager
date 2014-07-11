$(document).ready(function() {
	$('#loginform input[required], #clientadd input[required]').on('keyup change', function() {
		var $form = $(this).closest('form'),
		$group = $(this).closest('.input-group'),
			$addon = $group.find('.input-group-addon'),
			$icon = $addon.find('span'),
			state = false;
		
		if (!$group.data('validate')) {
			state = $(this).val() ? true : false;
		}else if ($group.data('validate') == "email") {
			state = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test($(this).val())
		}else if($group.data('validate') == 'phone') {
			state = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/.test($(this).val())
		}else if ($group.data('validate') == "length") {
			state = $(this).val().length >= $group.data('length') ? true : false;
		}
	
		if (state) {
			$addon.removeClass('danger');
			$addon.addClass('success');
			$icon.attr('class', 'glyphicon glyphicon-ok');
		}else{
			$addon.removeClass('success');
			$addon.addClass('danger');
			$icon.attr('class', 'glyphicon glyphicon-remove');
		}
		
		if ($form.find('.input-group-addon.danger').length == 0) {
			$form.find('[type="submit"]').prop('disabled', false);
		}else{
			$form.find('[type="submit"]').prop('disabled', true);
		}
	});
    
	$('#loginform input[required]').trigger('change');
	
	$("#mytable").tablesorter();
	
	$( "#datepicker" ).datepicker();
	
	$('.filterable .filters').hide();
	
	$('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
	    
	    $('.filterable .filters').show();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
	    $('.filterable .filters').hide();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
    
     dialog = $( "#dialog-form" ).dialog({
	autoOpen: false,
	height: 500,
	width: 500,
	modal: true,
	close: function() {
		form[ 0 ].reset();
		allFields.removeClass( "ui-state-error" );
	}
	});
    
     $( "#show_image" ).button().on( "click", function() {
	dialog.dialog( "open" );
	});
    
	
});