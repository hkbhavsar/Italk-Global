<?php 
		function curlposting($url1 , $result , $header , $sec = 60){
		$Curl_Session = curl_init($url1);
		curl_setopt ($Curl_Session, CURLOPT_POST, 1);
		curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "$result");
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, FALSE);   
		curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($Curl_Session, CURLOPT_TIMEOUT, $sec);
		curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
		if($header != ''){
			curl_setopt($Curl_Session, CURLOPT_HEADER, 0);
			curl_setopt($Curl_Session, CURLOPT_HTTPHEADER, $header);		
		}	
		$res = curl_exec ($Curl_Session);
		curl_close ($Curl_Session);
		return $res;
	}
		
		$process_id = $_POST['pid'];
		echo $sel_leads = "select * from tbl_leads where id in ($process_id)";
		$res_leads = mysql_query($sel_leads);
		while($row_leads1 = mysql_fetch_assoc($res_leads)){
			$row_leads[] = $row_leads1;
	}
		
		echo "<pre>";
		print_r($row_leads);exit;
		
		$url_1 = 'http://leadtrading.autobuyingsolutionsinc.com/AutomotiveFinance.asmx/DynamicPricePing';//DynamicPricePing
		$url_2 = 'http://leadtrading.autobuyingsolutionsinc.com/AutomotiveFinance.asmx/Post';
		
		
		$header = array();		
		$header[] = "Content-Type: application/x-www-form-urlencoded";	
		
		$price = '';
		$providerId = '262';
		$postalCode = $row_leads[$ij]['zip'];
		$socialSecurityNumber = $row_leads[$ij]['ssn'];
//		$socialSecurityNumber = '999999999';
		
		$grossMonthlyIncome = $row_leads[$ij]['monthly_income'];
	
		$providerData = '';
		$reservationCode = 'RRRRRRR';
		$prefix = '';
		$firstName = $row_leads[$ij]['fname'];
		$lastName = $row_leads[$ij]['lname'];
		$suffix = '';
		$emailAddress = $row_leads[$ij]['email'];
		$address = $row_leads[$ij]['address'];
		$address2 = '';
		$city = $row_leads[$ij]['city'];
		$province = $row_leads[$ij]['state'];
		$homePhone = $row_leads[$ij]['phone'];
		$workPhone = $row_leads[$ij]['phone'];
		$workPhoneExt = '';
		list($birth_year , $birth_month , $birth_day) = explode("-",$row_leads[$ij][birthday]);
			$date_of_birth = $birth_month . '/' . $birth_day . '/' . $birth_year;
		$birthDate = $date_of_birth;		
		$monthsAtResidence = (int) substr($row_leads[$ij]['year_of_resi'] , 3 , 2);
		$yearsAtResidence = (int) substr($row_leads[$ij]['year_of_resi'] , 0 , 2);
		$residenceType = ($row_leads[$ij]['rent_own'] == 'own') ? "Own" : 'Rent';
		
		$residenceMonthlyPayment = $row_leads[$ij]['home_pay'];
		$employer = $row_leads[$ij]['employer'];
		$jobTitle = $row_leads[$ij]['occupation'];
		$monthsAtEmployer = (int) substr($row_leads[$ij]['months_of_emp'] , 3 , 2);//employmentMonths
		$yearsAtEmployer = (int) substr($row_leads[$ij]['months_of_emp'] , 0 , 2);//employmentYears
		$ipAddress = $row_leads[$ij]['IP_address'];
		$hasBankruptcy = ($row_leads[$ij]['bankrupt'] == 'yes') ? 'True' : 'False';
		$hasCosigner = ($row_leads[$ij]['co_sign'] == 'yes') ? 'True' : 'False';
		$agreesToConditions = 'True';
		$authorizedCreditCheck = 'True';
		$notes = '';


		
		
	
		$ping_data =	'providerId='.$providerId
						.'&grossMonthlyIncome='.$grossMonthlyIncome
						.'&socialSecurityNumber='.$socialSecurityNumber
						.'&postalCode='.$postalCode;

		$post_data =	'providerId='.$providerId
						.'&providerData='.$providerData
						.'&reservationCode='.$reservationCode
						.'&prefix='.$prefix 
						.'&firstName='.$firstName 
						.'&lastName='.$lastName 
						.'&suffix='.$suffix 
						.'&emailAddress='.$emailAddress 
						.'&address='.$address 
						.'&address2='.$address2 
						.'&city='.$city 
						.'&province='.$province 
						.'&postalCode='.$postalCode 
						.'&homePhone='.$homePhone 
						.'&workPhone='.$workPhone 
						.'&workPhoneExt='.$workPhoneExt 
						.'&mobilePhone='.$mobilePhone 
						.'&socialSecurityNumber='.$socialSecurityNumber 
						.'&birthDate='.$birthDate 
						.'&monthsAtResidence='.$monthsAtResidence 
						.'&yearsAtResidence='.$yearsAtResidence 
						.'&residenceType='.$residenceType 
						.'&residenceMonthlyPayment='.$residenceMonthlyPayment 
						.'&employer='.$employer 
						.'&jobTitle='.$jobTitle 
						.'&monthsAtEmployer='.$monthsAtEmployer 
						.'&yearsAtEmployer='.$yearsAtEmployer 
						.'&grossMonthlyIncome='.$grossMonthlyIncome 
						.'&ipAddress='.$ipAddress 
						.'&hasBankruptcy='.$hasBankruptcy 
						.'&hasCosigner='.$hasCosigner 
						.'&agreesToConditions='.$agreesToConditions 
						.'&authorizedCreditCheck='.$authorizedCreditCheck 
						.'&notes='.$notes;
		
?>
         <tr>
              <td width="1%"><a href="#"><?php echo $_POST['pid'];?></a></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
     
            </tr>
		
			
        