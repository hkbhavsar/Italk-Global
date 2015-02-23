<div class="page-header">
  <h2>Revenue Report</h2>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Revenue Report</h2>
    </header>
   <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
         <div class="g_1_4">
            <label for="af-present">Start Date: </label>
          </div>
          <div class="g_3_4_last">
            <div class="g_1_3">
            <input type="text" data-validation-type="present" name="search_startdate" value="<?php echo $_POST['search_startdate'];?>"  id="datepicker-default_end" class="datepicker" />
            </div>
            <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">End Date: </label>
          </div>
            <div class="g_1_4">
           <input type="text" data-validation-type="present" name="search_enddate" value="<?php echo $_POST['search_enddate'];?>"  id="datepicker-default" class="datepicker" />
            </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
           <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Submit" name="submit_btn" id="submit_btn" /></div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
          <hr/>
          <?php 
         
          if(count($leadsData)!=0){
              
          foreach($leadsData as $key=>$value){
              
              $total = $total + $value->sum_price;
           ?>
          <div class="g_1_4">
              <label for="af-present"><?echo ucfirst($value->vUsername);?>:</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_5">
                 <input type="text" name="leadbid_auto" id="leadbid_auto" value="$<?echo $value->sum_price;?>" >
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <?php }}else{?>
           <div class="g_1_4">
              <label for="af-present">No any data found..!!</label>
          </div>
          <?php }?>
           
          <div class="g_1_4_last">
            <label for="af-present"><strong>TOTAL : &nbsp;$<?php echo $total>0?$total:0;?></strong></label>
          </div>
          <!--<div class="g_3_4_last">
              <div class="g_1_5">
                 <input type="text" name="total" id="total" value="<?php echo $total;?>" >
              </div>
          </div>-->
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
        
      </form>
     </div>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>
