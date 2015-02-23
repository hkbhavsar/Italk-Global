<div id="content-main-inner">
 <!-- widgets management panel --> 
    <div id="powerwidgetspanel" class="powerwidgetspanel">
        <header>
            <h2>Power widgets panel</h2>
        </header>
        <div class="powerwidgetspanel-widget" data-widget-id="widget1">
            <input type="checkbox">
            <label>Minimal media</label>
        </div>
        <div class="powerwidgetspanel-widget" data-widget-id="widget2">
            <input type="checkbox">
            <label>Form examples</label>
        </div>
        <div class="powerwidgetspanel-widget" data-widget-id="widget3">
            <input type="checkbox">
            <label>Lead Company</label>
        </div> 
        <div class="powerwidgetspanel-widget" data-widget-id="widget4">
            <input type="checkbox">
            <label>Custom made icons</label>
        </div>   
        <div class="powerwidgetspanel-widget" data-widget-id="widget10">
            <input type="checkbox">
            <label>Leads Detail</label>
        </div>  
    </div> 

    <div class="page-header">
        <h2>Welcome to the iTalkGlobal <?php if(Auth::instance()->get_user()->role_id==1){?>Admin<?php }else{?>Agent<?php }?> panel</h2>
        <!--<span class="page-helper">1.0</span>
         <a href="documentation.html" class="page-helper">Documentation</a>
         <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>-->
        <p><!--Welcome to the iTalkAdmin panel.--></p>
    </div>
<!-- Start grid -->
<?php if(Auth::instance()->get_user()->role_id==1){?>
    <!--<section class="g_1_1">
        <div class="powerwidget" id="widget1">
            <header>
                <h2>Total Leads</h2>                                  
            </header>
            <div> 
                <div class="inner-spacer"> 
                 <div class="well" id="zc"></div>
                </div>                                
            </div>
        </div>
    </section>-->

    <section class="g_1_1">
         <div class="powerwidget" id="widget1">
            <header>
                <h2>Total Leads in System</h2>                                  
            </header>
            <div> 
                <div class="inner-spacer"> 
                    <div class="well" id="zc1"></div>
                </div>                                
            </div>
        </div><!-- End .powerwidget --> 
    </section>                           
    <div class="clear"><!-- New row --></div>
   <?php }else{?>
     <section class="g_1_1">
        <div class="powerwidget" id="widget1">
            <header>
                <h2>Total Leads</h2>                                  
            </header>
            <div> 
                <div class="inner-spacer"> 
                 <div>
                     
                     <table class="basic-table" id="tableexample1">
          <thead>
            <tr>
              <!--<th><?php echo "Edit";?></th>-->
              <th scope="col">Date</th>
              <th scope="col">Phone</th>
              <th scope="col">Campaign Type</th>
              <th scope="col">Fname</th>
              <th scope="col">Lname</th>
              <th scope="col">Email</th>
              <th scope="col">Zip</th>
              <th scope="col">Comment</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
              <?php
			 
	if(count($paydayleadsData)>0){?>
            <?php foreach($paydayleadsData as $key=>$value){?>
              <tr>
                  <!--<td>&nbsp;&nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>foragent/newpayday/<?php echo $value->newpayday_id;?>"><img src="<?php echo Kohana::$base_url; ?>images/edit.gif" alt="Edit"></a></td>-->
                  <td><?php print_r(date('m-d-Y',strtotime($value->create_date)));?></td>
                  <td><?php print_r($value->phone);?></td>
                  <td><?php print_r("New Payday");?></td>
                  <td><?php print_r($value->fname);?></td>
                  <td><?php print_r($value->lname);?></td>
                  <td><?php print_r($value->email);?></td>
                  <td><?php print_r($value->zip);?></td>
                  <td><?php print_r($value->comment);?></td>
                  <td><?php //print_r($value->fname);?>-</td>
              </tr>
             <?php }}
			 
	else if(count($insurancesLeadData)>0){?>
            <?php foreach($insurancesLeadData as $key=>$value){?>
              <tr>
                  <!--<td>&nbsp;&nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>foragent/newpayday/<?php echo $value->lead_insurance_id;?>"><img src="<?php echo Kohana::$base_url; ?>images/edit.gif" alt="Edit"></a></td>-->
                  <td><?php print_r(date('m-d-Y',strtotime($value->created_date)));?></td>
                  <td>N/A</td>
                  <td><?php print_r("Auto Insurance");?></td>
                  <td><?php print_r($value->fname);?></td>
                  <td><?php print_r($value->lname);?></td>
                  <td><?php print_r($value->applicantEmail);?></td>
                  <td><?php print_r($value->applicantZip);?></td>
                  <td><?php print_r($value->comment);?></td>
                  <td><?php //print_r($value->fname);?>-</td>
              </tr>
             <?php }}else{?>
                <tr>
                    <td colspan="11" style="text-align: center">No any leads found</td>
              </tr>
              <?php }?>
          </tbody>
                     </table>
                     
                 </div>
                </div>                                
            </div>
        </div><!-- End .powerwidget --> 
    </section>
    
     <section class="g_1_1">
         <div class="powerwidget" id="widget2">
            <header>
                <h2>Reminder</h2>                                  
            </header>
            <div> 
                <div class="inner-spacer"> 
                    <div >
                        
                         <table class="basic-table" id="tableexample1">
          <thead>
            <tr>
             
              <th><?php echo "Edit";?></th>
              <th scope="col">Date</th>
               <th scope="col">Phone</th>
               <th scope="col">Campaign Type</th>
              <th scope="col">Fname</th>
              <th scope="col">Lname</th>
              <th scope="col">Email</th>
              <th scope="col">Zip</th>
              <th scope="col">Comment</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
              <?php if(count($paydayleadsData_reminder)>0){ $i=1; $l = 2;?>
            <?php foreach($paydayleadsData_reminder as $key=>$value){?>
              <tr>
                  
                  <td>&nbsp;&nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>foragent/newpayday/<?php echo $value->newpayday_id;?>"><img src="<?php echo Kohana::$base_url; ?>images/edit.gif" alt="Edit"></a></td>
                  <td><?php print_r(date('m-d-Y',strtotime($value->create_date)));?></td>
                  <td><?php print_r($value->phone);?></td>
                  <td><?php print_r("New Payday");?></td>
                  <td><?php print_r($value->fname);?></td>
                  <td><?php print_r($value->lname);?></td>
                  <td><?php print_r($value->email);?></td>
                  <td><?php print_r($value->zip);?></td>
                  <td><?php print_r($value->comment);?></td>
                  <td><?php //print_r($value->fname);?>-</td>
              </tr>
             <?php }}else{?>
                         <tr>
                    <td colspan="11" style="text-align: center">No any Reminder</td>
              </tr>
              <?php }?>
          </tbody>
                     </table>
                     
                        
                    </div>
                </div>                                
            </div>
        </div><!-- End .powerwidget --> 
    </section>
     
   <?php }?>
</div><!-- End #content-main-inner --> 