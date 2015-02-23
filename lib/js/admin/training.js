function updatestep(step)
    {
        var base_url = document.getElementById("baseurl").value;
       $.ajax({
                    type: 'get',
                    url: base_url+'index.php/training/updateuserstep',
                    data: {'step': step},
                    success:function(result){

                    }
                    });
    }
function checkstpscount(checkstep,gotostep)
    {
        var base_url = document.getElementById("baseurl").value;
       $.ajax({
                    type: 'get',
                    url: base_url+'index.php/training/checksteps',
                    data: {'checkstep': checkstep},
                    success:function(result){
                        if(result!='')
                            alert(result);
                        else
                            window.location=base_url+"index.php/training/step"+gotostep;
                    }
              });
    }

  var txt = 'Please enter password:<br /><input type="password" id="alertName" name="alertName" value="" />';


function mysubmitfunc(v,m,f){

	an = m.children('#alertName');
	if(f.alertName == ""){
		an.css("border","solid #ff0000 1px");
		return false;
	}
        else{
            var base_url = document.getElementById("baseurl").value;
            var gotostep = document.getElementById("gotostep").value;
            var checkstep = document.getElementById("checkstep").value;
            var getpassword = f.alertName;
            $.ajax({
                    type: 'get',
                    url: base_url+'index.php/training/checkpassword',
                    data: {'password': getpassword,'step': gotostep},
                    success:function(result){

                        if(result!='')
                            alert(result);
                        else
                            checkstpscount(checkstep,gotostep);
                    }
              });
        }

}
