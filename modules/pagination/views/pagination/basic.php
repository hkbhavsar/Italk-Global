<script type="text/javascript">
   
    function gotoPage(url){
        
        var t = getQueryVariable('tab',url);
        if(t != false){
            window.location.href = eval('url.replace(/tab='+t+'/ig, "tab='+$('#hidactivetab').val()+'")');        
        }else{
            var sap = (url.indexOf('?') == -1)?'?':'&';
            window.location.href = url+sap+'tab='+$('#hidactivetab').val();
        }
        //return false;
    }
    function getQueryVariable(variable,url) {
      var query = '';
      var sepindex = url.indexOf('?');
      if(sepindex != -1){       
      query =url.substring(sepindex+1);//window.location.search.substring(1);
      var vars = query.split("&");
      for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
          return pair[1];
        }
      }
      
      }
      //alert('Query Variable ' + variable + ' not found');
      return false;
      
    } 
</script>
<input type="hidden" name="hidactivetab" id="hidactivetab" value="<?php if(isset($_REQUEST['tab'])){echo $_REQUEST['tab'];}?>" />
<div class="pagination" id="paging" style="text-align:center;">
     <ul class="paginator">
         
	<?php if ($first_page !== FALSE): ?>
		<li><a href="javascript:gotoPage('<?php echo HTML::chars($page->url($first_page)) ?>')" rel="first"><?php echo __('First') ?></a></li>
	<?php else: ?>
		<!--<li><strong><?php //echo __('First') ?></strong></li>-->
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<li><a href="javascript:gotoPage('<?php echo HTML::chars($page->url($previous_page)) ?>')" rel="prev"><?php echo __('Previous') ?></a></li>
	<?php else: ?>
		<!--<li><?php //echo __('Previous') ?></li>-->
	<?php endif ?>
    	<!--<li><strong><?php echo $current_page." / ".$total_pages ?></strong></li>-->
	<?php  for ($i = 1; $i <= $total_pages; $i++): ?>
		<?php if ($i == $current_page): ?>
			<li  class="current"><strong><a href="#"><?php echo $i ?></a></strong></li>
		<?php else: ?>
			<li><a href="javascript:gotoPage('<?php echo HTML::chars($page->url($i))?>')" id="test2"><?php echo $i ?></a></li>
		<?php endif ?>

	<?php endfor ?>

	<?php if ($next_page !== FALSE): ?>
		<li><a href="javascript:gotoPage('<?php echo HTML::chars($page->url($next_page)) ?>')" rel="next"><?php echo __('Next') ?></a></li>
	<?php else: ?>
		<!--<li><?php //echo __('Next') ?></li>-->
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<li id="tt"><a href="javascript:gotoPage('<?php echo HTML::chars($page->url($last_page)) ?>')" rel="last"><?php echo __('Last') ?></a></li>
	<?php else: ?>
		<!--<li><?php //echo __('Last') ?></li>-->
	<?php endif ?>
    </ul>                
</div><!-- .pagination -->