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

function checkLeadSelected(cbGroup,numberOfLeads)
{
    isLeadChecked = 0;
    // Loop through the array
    for (i = 0; i < cbGroup.length; i++)
    {
            if(cbGroup[i].checked)
            {
                isLeadChecked = 1;
            }
    }
    if(isLeadChecked){
        return true;
    }else{

        isNumberOfLeadsSelected = 0;
        for(k = 0; k < numberOfLeads.length; k++)
        {
            if(numberOfLeads[k].selected && numberOfLeads[k].value !=""){
                isNumberOfLeadsSelected = 1;
            }
        }    

        if(isNumberOfLeadsSelected == 0)
        {
            alert('Please Select Atleast One Lead')
            return false;
        }
    }

    return true;
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



