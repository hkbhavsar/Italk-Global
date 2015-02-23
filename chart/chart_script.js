
function render(base_url) {
        /*zingchart.render({
                id : 'zc',
                output : 'flash',
                width : '100%',
                height : 400,
                dataurl : base_url+'chart/pie_dark.txt',
                liburl : base_url+'chart/flash_scripts/zingchart.swf',
                preservecontainer : true
        });*/

        zingchart.render({
                id : 'zc1',
                output : 'flash',
                width : '100%',
                height : 400,
                dataurl : base_url+'chart/Leads_Client.txt',
                liburl : base_url+'chart/flash_scripts/zingchart.swf',
                preservecontainer : true
        });
}
$(document).ready(function() {
        var base_url = $("#base_url").val();
        render(base_url);
});
		