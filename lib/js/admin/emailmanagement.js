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

function creative_confirmation(rec_id) {

	var answer = confirm("Are you sure you want to delete this creative?")
	if (answer){
		window.location = "deletecreative/"+rec_id;
	}
	else{
		return false;
	}
}

function rule_confirmation(rec_id) {

	var answer = confirm("Are you sure you want to delete this Rule Set?")
	if (answer){
		window.location = "../deleterule/"+rec_id;
	}
	else{
		return false;
	}
}

function campaign_confirmation(rec_id) {

	var answer = confirm("Are you sure you want to delete this Campaign?")
	if (answer){
		window.location = "deletecampaign/"+rec_id;
	}
	else{
		return false;
	}
}
$(function() {
        var dates = $( "#from, #to" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 2,
                onSelect: function( selectedDate ) {
                        var option = this.id == "from" ? "minDate" : "maxDate",
                                instance = $( this ).data( "datepicker" );
                                date = $.datepicker.parseDate(
                                        instance.settings.dateFormat ||
                                        $.datepicker._defaults.dateFormat,
                                        selectedDate, instance.settings );
                        dates.not( this ).datepicker( "option", option, date );
                }
        });
});
