function setActiveTab(elementId){
    if(elementId == 'box1-tabular-tab'){
        //$('#search_container').show();
        //$('#empty_search_container').hide();
        $('#search_container :input').removeAttr('disabled');
        $('#box1').width('');
        $('#searchall_box_container').attr('class','');
        $('#searchall_box_container .transparentbutton').attr('class','button');
    }else{
        //$('#search_container').hide();
        $('#search_container :input').attr('disabled', true);
        //$('#empty_search_container').show();
        //$('#box1').width('930');
        $('#searchall_box_container').attr('class','transparentdiv');
        $('#searchall_box_container .button').attr('class','transparentbutton');

    }
    $.cookie('box1_tab', elementId);
    //$('#hidactivetab').val(elementId);
}

function checkUncheckAll(checkAllState, cbGroup)
{

	// Check that the group has more than one element
	if(cbGroup.length > 0)
	{
		// Loop through the array
		for (i = 0; i < cbGroup.length; i++)
		{
			cbGroup[i].checked = checkAllState.checked;
		}
	}
	else
	{
		// Single element so not an array
		cbGroup.checked = checkAllState.checked;
	}
}

function confirmation(rec_id) {

	var answer = confirm("Are you sure you want to delete this prospects?")
	if (answer){
		window.location = "delete/"+rec_id;
	}
	else{
		return false;
	}
}
$(function() {
        var dates = $( "#from, #to, #filter_contacted_from, #filter_contacted_to, #filter_date_visited_from, #filter_date_visited_to, #filter_date_convert_member_from, #filter_date_convert_member_to" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 2,
                onSelect: function( selectedDate ) {
                        var option = this.id == "from" || this.id == "filter_contacted_from"  || this.id == "filter_date_visited_from" || this.id == "filter_date_convert_member_from" ? "minDate" : "maxDate",
                                instance = $( this ).data( "datepicker" );
                                date = $.datepicker.parseDate(
                                        instance.settings.dateFormat ||
                                        $.datepicker._defaults.dateFormat,
                                        selectedDate, instance.settings );
                        dates.not( this ).datepicker( "option", option, date );
                }
        });
});

function clearForm(oForm){
    var frm_elements = oForm.elements;
    for(i=0; i<frm_elements.length; i++)
    {
        // code for accessing each element goes here
        field_type = frm_elements[i].type.toLowerCase();
        switch (field_type)
        {
            case "text":
            case "password":
            case "textarea":
                frm_elements[i].value = "";
                break;
            case "checkbox":
                if (frm_elements[i].checked)
                {
                    frm_elements[i].checked = false;
                }
                break;
        case "select-one":
        case "select-multi":
            frm_elements[i].selectedIndex = 0;
            break;
        default:
            break;
        }
    }
}



