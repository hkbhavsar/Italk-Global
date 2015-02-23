		function deleteRule (rule_id){
			
			var answer = confirm("Are you sure you want to delete this rule?")
			if (!answer){
				return false;
			}

			var base_url = window.location.hostname + '/v1';
			var folder = '/v1/';

			///(http:\/\/)?(www)[^\/]+\//i
			$('#rule_set').prepend('');
	
			$.getJSON('../deleterule/'+rule_id, function(data){
				var new_row = '';
				//var date_str = getMonth() +'-'+getDate()+'-'+getYear();
				$('#rule_set').empty();
				$.each(data, function(key,val){
					new_row = '';
					if (val.error){
						alert('error');
					}else{
						//alert('result');//getRules ();
						getRules();
					}
				});
		    })
		}
		
		function getRules (){

			var campaign_id=$('#email_campaign_id').val();
			var base_url = window.location.hostname + '/v1';
			var folder = '/v1/';

			///(http:\/\/)?(www)[^\/]+\//i
			$('#rule_set').prepend('');
	
			$.getJSON('../getrules/'+campaign_id, function(data){
				var new_row = '';
				//var date_str = getMonth() +'-'+getDate()+'-'+getYear();
				$('#rule_set').empty();
				$.each(data, function(key,val){
					new_row = '';
					if (val.error){
						
						$('#message_box').prepend("Error: " + val.error + "<br>");
					}else{
						$('#email_campaign_id').val(val.email_campaign_id);

						new_row +=  '<tr class="">';
                        new_row +=  '<td width="15%">'+val.email_action_code+'</td>';
                        new_row +=  '<td width="10%">'+val.action_value+'</td>';
                        new_row +=  '<td width="40%">'+val.subject+'</td>';
                        new_row +=  '<td width="20%">'+val.date_added+'</td>';
                        new_row +=  '<td width="15%">';
                        new_row +=  '<a title="edit" href="'+val.email_campaign_id+'_'+val.id+'" class="ico"><img alt="edit" src="'+folder+'/lib/css/admin/img/led-ico/pencil.png"></a>';
                        new_row +=  '&nbsp;<a title="delete" style="cursor: pointer;" onclick="deleteRule('+val.id+')"  class="ico"><img alt="delete" src="'+folder+'/lib/css/admin/img/led-ico/delete.png"></a>';
                        //new_row +=  '&nbsp;&nbsp;<a title="view" href="'+base_url+'index.php/viewdetail/detailview/'+val.id+'" class="ico"><img alt="edit" src="'+folder+'/lib/css/admin/img/led-ico/view.png"></a>';
                        new_row +=  '</td></tr>';
						$('#rule_set').append(new_row);					
					}
				});
		    })
		    alert("Campaign Updated");
		}	
		
		
		


	$(document).ready(function() {
		var total_cnt = 0;
		if ($('#email_campaign_id').val() > 0){
			
		}
		$('#add_rule').click(function() {	
			total_cnt = 0;
			$('#email_rule_id').val(0);
			saveCampaign(0);
		});

		$('#update_rule').click(function() {	
			if ($('#email_rule_id').val() < 1)
				{
					alert("You must select an Email to update");
					return;
				}
			saveCampaign(0);
		});
		
		
		function saveCampaign (cnt){
			var base_url = window.location.hostname + '/v1';
			var folder = '/v1/';

			///(http:\/\/)?(www)[^\/]+\//i
			$('#rule_set').prepend('');
			var live_btn = $("input[name='live_draft']:checked").val();
			
			var radio_btn = $("input[name='action_type']:checked").val();
			var live_btn = $("input[name='live_draft']:checked").val();
			email_action = 0;
			switch(radio_btn)
			{
				case 'PreEnrolleeAddedDays':
					action_value = $('#PreEnrolleeAddedDays_value').val();
				   break;
				case 'NewMemberJoinedDays':
					action_value = $('#NewMemberJoinedDays_value').val();
				  break;
				case 'DeadlineDays':
					action_value = $('#DeadlineDays_value').val();
					  break;
				case 'TimeOutDays':
					action_value = $('#TimeOutDays_value').val();
					  break;
				case 'LastVisitDays':
					action_value = $('#LastVisitDays_value').val();
					  break;
				case 'DayOfWeek':
					action_value = $('#DayOfWeek_value').val();
					  break;
				case 'DayOfMonth':
					action_value = $('#DayOfMonth_value').val();
					  break;				  
				case 'DailySummary':
					action_value = '';
					  break;				  
				case 'OrderReceipt':
					action_value = '';
					  break;
				case 'SingleMessage':
					action_value = '';
					  break;						  
				default:
			}
			var body =  CKEDITOR.instances.body ;
			
			$.getJSON('../savecampaign?short_description='+$('#description').val()+'&subject='+$('#subject').val()+'&status_name='+$('#status_name').val()+'&member_type ='+$('#member_type').val()+'&email_action_code ='+radio_btn+'&status_name='+$('#status_name').val()+'&action_value ='+action_value+'&email_campaign_id='+$('#email_campaign_id').val()+'&email_rule_id='+$('#email_rule_id').val()+'&body='+escape(body.getData())+'&status_operator='+$('#status_operator').val()+'&lead_type='+$('#lead_type').val()+'&live='+live_btn, function(data){
				var new_row = '';
				//var date_str = getMonth() +'-'+getDate()+'-'+getYear();
				$('#rule_set').empty();
				$.each(data, function(key,val){
					new_row = '';
					if (val.error){
						
						$('#message_box').prepend("Error: " + val.error + "<br>");
					}else{
						$('#email_campaign_id').val(val.email_campaign_id);

						new_row +=  '<tr class="">';
                        new_row +=  '<td width="15%">'+val.email_action_code+'</td>';
                        new_row +=  '<td width="10%">'+val.action_value+'</td>';
                        new_row +=  '<td width="40%">'+val.subject+'</td>';
                        new_row +=  '<td width="20%">'+val.date_added+'</td>';
                        new_row +=  '<td width="15%">';
                        new_row +=  '<a title="edit" href="'+val.email_campaign_id+'_'+val.id+'" class="ico"><img alt="edit" src="'+folder+'/lib/css/admin/img/led-ico/pencil.png"></a>';
                        new_row +=  '&nbsp;<a title="delete" style="cursor: pointer;" onclick="deleteRule('+val.id+')"  class="ico"><img alt="delete" src="'+folder+'/lib/css/admin/img/led-ico/delete.png"></a>';
                        //new_row +=  '&nbsp;&nbsp;<a title="view" href="'+base_url+'index.php/viewdetail/detailview/'+val.id+'" class="ico"><img alt="edit" src="'+folder+'/lib/css/admin/img/led-ico/view.png"></a>';
                        new_row +=  '</td></tr>';
						$('#rule_set').append(new_row);					
					}
				});
		    })
		    alert("Campaign Updated");
		}
		
	
				
	});

	