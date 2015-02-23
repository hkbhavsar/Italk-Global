$(document).ready(function() {
    if($.cookie('box1_tab') == null )
    {
        $('#box1-tabular-tab').click();
    }else{
        tab_selected = $.cookie('box1_tab');
        $('#' + tab_selected).click();
    }

    var tab_param = gup('tab');
    
    if(tab_param=='recent')
        $('#box1-tabular-tab').click();
    
    $("#div_advanced_search").hide();

    $("#switch_to_advanced").click(function(){
        $("#div_advanced_search").show();
        $("#div_simple_search").hide();
        $("#search_header").html('Advanced Search');
    });

    $("#switch_to_simple").click(function(){
        $("#div_simple_search").show();
        $("#div_advanced_search").hide();
        $("#search_header").html('Search');
    });
});


function gup( name )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return results[1];
}
    
function setActiveTab(elementId){
    $.cookie('box1_tab', elementId);
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