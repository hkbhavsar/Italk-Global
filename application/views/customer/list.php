<script type="text/javascript">
    $(document).ready(function() {

        //syntax highlighter
        hljs.tabReplace = '    ';
        hljs.initHighlightingOnLoad();

        //accordion
        $('h3.accordion').accordion({
            defaultOpen: 'section1',
            cookieName: 'accordion_nav',
            speed: 'slow',
            animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
                elem.next().slideFadeToggle(opts.speed);
            },
            animateClose: function (elem, opts) { //replace the standard slideDown with custom function
                elem.next().slideFadeToggle(opts.speed);
            }
        });
	
				

        //custom animation for open/close
        $.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
        };

    });
</script>
<!--[if IE 7]>
<style>
.accordion-open, .collapse-open{height:20px;}
</style>
<![endif]-->

<?php if (Session::instance()->get('session_msg') != '') { ?>
    <div class="succes">
        <div class="succes_icon"><!-- --></div>
        <a href="#" class="close" title="Close this notification">x</a>
        <div class="desc">
            <span>Success!</span>
            <p><?php echo Session::instance()->get('session_msg');
    Session::instance()->delete('session_msg'); ?></p>
        </div>
    </div>
<?php } ?>
<h2>Customers</h2>
<div class="clear"></div> 
<div id="body">
    <div id="accordion">
        <!-- panel -->
        <h3 class="accordion accordion-close" id="body-section1">Search<span></span></h3>
        <div style="display: none;" class="container">
            <fieldset><legend>Search Customer</legend>
                <div class="content">
                    <form action="#" method="post"><!-- Form -->
                        <div style="width:100%;">
                          <div style="width:37%" class="input_field">
                            <label for="sf">Enter Keyword&nbsp;:&nbsp; </label>
                            <input type="text" value="" name="cust_work_phone" class="mediumfield required"/>
                            <span class="field_compulsory">*</span> </div>
                          <div style="width:31%" class="input_field">
                              <select class="mediumfield required" name="dropdown" style="padding: 5px;">
                                <option>Name</option>
                                <option>Company</option>
                                <option>Phone</option>
                            </select>
                              <span style="float: right;"><input type="submit" value="Submit" class="submit"/></span>
                          </div>
                        </div>
                    </form>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="clear"></div> 
<table cellspacing="0" cellpadding="0" border="0">
    <!-- Table -->
    <thead>
        <tr>
            <th><input type="checkbox" class="checkall" /></th>
            <th>No</th>
            <th>Customer Name</th>
            <th>Company</th>
            <th>Email Address</th>
            <th>Work Phone</th>
            <th>Mobile Phone</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($custdata as $customer) {
            $class = $i % 2 == 0 ? '' : 'alt';
            ?>
            <tr class="<?php echo $class; ?>">
                <td><input type="checkbox" /></td>
                <td><?php echo $i; ?></td>
                <td><?php echo $customer->first_name . " " . $customer->last_name; ?></td>
                <td><?php echo $customer->cust_company; ?></td>
                <td><?php echo $customer->cust_email; ?></td>
                <td><?php echo $customer->work_phone; ?></td>
                <td><?php echo $customer->mobile_phone; ?></td>
                <td><?php echo date('m-d-Y', strtotime($customer->date_added)); ?></td>
                <td><a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/basket_put.png" alt="Add" title="Add Order" /></a>
                    &nbsp;&nbsp;<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/address_add.png" alt="Add Address" title="Add Address"></a>
                    &nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>customer/create/<?php echo $customer->cust_id; ?>"><img src="<?php echo Kohana::$base_url; ?>assets/action_edit.png" alt="Edit" title="Edit Customer"></a>&nbsp;&nbsp;<!--<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/action_delete.png" alt="Delete"  title="Delete Customer"/></a>--></td>
            </tr>
    <?php $i++;
} ?>
    </tbody>
</table>
<?php echo $pagging_links; ?>
</div>
