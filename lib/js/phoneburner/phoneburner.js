/**
 * 
 */

function sendToJavaScript(x) 
{
	alert(x);

	var actualbody = x.substring(6);
  	var retarray = actualbody.split("&");
  	var myobject = new Object;
    
  	var len = retarray.length;
  	for( var i=0; i<len; i++ )
  	{
    		var value = retarray[i];
    		singleval=value.split("=");
    		myobject[singleval[0]]=singleval[1];
  	}       
            
  	talker_cb( myobject );
}

function talker_cb( data )
{
	if ( ! data )
	{
		return false;
	}
alert( data.event );

	//  data.event
	//  	USER_CONNECTED  (data.callerid for phone number of user)
	//  	USER_DISCONNECTED
	//  	CONNECTED (current call answered)
	//  	HANGUP (current call hungup)
	//	DIALING (current call started dialing)
}

function load_talker( id )
{

	var so = new SWFObject('http://www.phonedispatcher.com/burntalker2.swf', 'website', 1, 1, '9.0.0', '#ffffff');
	alert("ID:" + id + ":");	   
	so.addParam('scale', 'noscale');
	so.addParam('quality', 'high');
	so.addParam('allowScriptAccess', 'always');
	so.addVariable("mysessionid", id);      
	so.addVariable("justcache", "no");
	so.write('flashcontent');

	browserflashversion=deconcept.SWFObjectUtil.getPlayerVersion().major+
	"."+deconcept.SWFObjectUtil.getPlayerVersion().minor+
	"."+deconcept.SWFObjectUtil.getPlayerVersion().rev;
}

function load_talker2( id )
{
	var so = new SWFObject('http://www.phonedispatcher.com/burntalker2.swf', 'website', 1, 1, '9.0.0', '#ffffff');
		   
	so.addParam('scale', 'noscale');
	so.addParam('quality', 'high');
	so.addParam('allowScriptAccess', 'always');
	so.addVariable("mysessionid", id);      
	so.addVariable("justcache", "no");
	so.write('flashcontent');

	browserflashversion=deconcept.SWFObjectUtil.getPlayerVersion().major+
	"."+deconcept.SWFObjectUtil.getPlayerVersion().minor+
	"."+deconcept.SWFObjectUtil.getPlayerVersion().rev;
}

function sendToJavaScript2(x) {
	alert('Send to Javascript');
    var actualbody = x.substring(6);
    var retarray = actualbody.split("&");
    var myobject = new Object;

    var len = retarray.length;
    for (var i = 0; i < len; i++) {
        var value = retarray[i];
        singleval = value.split("=");
        myobject[singleval[0]] = singleval[1];
    }

    talker_cb(myobject);
}

function talker_cb2(data) {
	alert('talker_cb');
    if (!data) {
        return false;
    }

    switch (data.event) {
        case "USER_CONNECTED":  alert('USER_CONNECTED'); break;
        case "USER_DISCONNECTED": location.reload(true);   break;
        case "CONNECTED":  alert('CONNECTED');    break;
        case "HANGUP":  alert('HANGUP');   break;
        case "DIALING": alert('DIALING');   break;
    }
}
