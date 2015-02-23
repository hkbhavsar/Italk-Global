
	$(document).ready(function() {
		
		var total_cnt = 0;
		var auth_key =$('#authkey').val();
		var session = $('#sesskey').val();
		var dsid = null;
		//getMessages();
		login();
		$('#pb_login').click(function() {	
			
		});
		
		$('#pb_dial_clients').click(function() {	
			dialClients();
		});

		$('#pb_dial').click(function() {	
			var value = $("input[@name=recordings]:checked").val();
			if (!value){
				alert("Select Recording to Play");
			}else{
				beginDial(value);
			}
		});
		function login(){
			$('#status').prepend('<br>Connecting to Phone Burner');
			$.getJSON('/v1/index.php/phoneburner/login', function(data){
				var login_info = '';
				if (data == null){
					$('#status').prepend('Connection Failed');
					return;
				}
				$.each(data, function(key,val){
					login_info += "<br>" + val.status + "," + val.message + " " + val.data.auth_key ;
					auth_key = val.data.auth_key;
					session = val.data.PHPSESSID;
					//session = 'testing';
					$('#status').prepend(login_info);
					$('#status_message').prepend(val.message);
					$('#status_session').prepend(val.data.PHPSESSID);
					$('#status_auth_key').prepend(val.data.auth_key);
				});
				getMessages();
				
				
		    })			
		}

		
		function getMessages(){
			$('#status').prepend('<br>Retieving Messages');
			$.getJSON('/v1/index.php/phoneburner/getmessages?auth_key='+auth_key+'&session='+session, function(data){
				var recordings  = '';
				var status  = '';
				if (data == null){
					$('#status').prepend('<br>Conection Failed');
					return;
				}

				$.each(data, function(key,val){
					status += "<br>" + val.status + "," + val.message;
					$('#status').prepend(status);
					var options = '';
					$.each(val.data, function(key2,val2){
						options = '<input type="radio" name="recordings" id="test" value="'+val2.recording_id+'"><div>' + val2.name+ "</div><div> " + val2.playback_url + "</div>";
						recording = val2.N + ", ";
						recording += val2.recording_id + ", ";
						recording += val2.account_id + ", ";
						recording += val2.recording + ", ";
						recording += val2.created_when + ", ";
						recording += val2.name + ", ";
						recording += val2.playback_url + " ";
						$('#recordings').append("<br>"+options);
					})

				});
		    })			
		}		
		
		function beginDial(id){
			$('#status').prepend('<br>Begining Dial');
			alert(session);
			$.getJSON('/v1/index.php/phoneburner/begin?auth_key='+auth_key+'&session='+session+'&recording_id='+id, function(data){
				var recordings  = '';
				var status  = '';
				if (data == null){
					$('#status').prepend('<br>Conection Failed');
					return;
				}

				$.each(data, function(key,val){
					status += "<br>" + val.status + "," + val.message;
					$('#status').prepend(status);
					
					dsid =  val.data.dsid;
					$('#dial_text').prepend("Call in Now:");
					$('#dial_id').prepend("DSID: " + val.data.dsid);
					$('#dial_num').prepend("Phone: " + val.data.dialin_num);
					$('#dial_pin').prepend("PIN: " + val.data.pin_code);


				});
		    })			
		}
		
		function dialClients(){
			$('#status').prepend('<br>Dial Clients');
			alert(session);
			load_talker(session);

			$.getJSON('/v1/index.php/phoneburner/call?auth_key='+auth_key+'&session='+session+'&dsid='+dsid+'&phone='+'8018540305', function(data){
				var recordings  = '';
				var status  = '';
				if (data == null){
					$('#status').prepend('<br>Conection Failed');
					return;
				}

				$.each(data, function(key,val){
					status += "<br>" + val.status + "," + val.message;
					$('#status').prepend(status);

				});
		    })			
		}
		
	});

	