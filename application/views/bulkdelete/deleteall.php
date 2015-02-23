<?php $user_role = Auth::instance()->get_user()->role_id;
          $in_report_menu = basename($_SERVER['REQUEST_URI']);
    ?>
<div id="powerwidgetspanel" class="powerwidgetspanel">
  <div class="powerwidgetspanel-widget" data-widget-id="widget1">
    <input type="checkbox"/>
    <label>Delete Leads For Agent</label>
  </div>
</div>
<div class="page-header">
  <h2>Delete Leads For Agent</h2><br>
</div>
<section class="g_1">
       <?php if (isset($total_rows) && $total_rows>=0) { ?>
    <div class="dialog error">
        <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png"><?php echo $total_rows; ?> Rows Deleted Successfully</p>
        <span>x</span>
    </div>
<?php } ?>
<div class="powerwidget" id="widget1">
    <header>
        <h2>Search</h2>
    </header>
    <div>
        <div class="inner-spacer">
            <form method="post" action="" id="search_form" autocomplete="off">
                <div class="g_1_4">
                    <label for="af-present">Campaign Type: *</label>
                </div>
                <div class="g_1_4">
                    <select name="search_campaign" id="search-searchin">
                        <option value="auto_sale" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'auto_sale' ? 'selected=selected' : ''; ?>>Auto</option>
                        <option value="newcar" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'newcar' ? 'selected=selected' : ''; ?>>New Car</option>
                        <option value="new_payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'new_payday' ? 'selected=selected' : ''; ?>>New Payday</option>
                        <option value="payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'payday' ? 'selected=selected' : ''; ?>>Payday</option>
                        <option value="insurance" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'insurance' ? 'selected=selected' : ''; ?>>Insurance</option>
                        <option value="credit_repair" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'credit_repair' ? 'selected=selected' : ''; ?>>Credit Repair</option>
                    </select>
                </div>
                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>
                <div class="g_1_4">
                    <label for="af-present">Call Center: </label>
                </div>
                <div class="g_3_4_last">
                    <div class="g_1_4">
                        <select name="search_callcenter">
                            <option value="">-- select option --</option>
                            <?php for ($i = 0; $i < count($callcenter_data); $i++) { ?>
                                <option value="<?php echo $callcenter_data[$i]->id; ?>" <?php echo isset($_POST['search_callcenter']) && $_POST['search_callcenter'] == $callcenter_data[$i]->id ? 'selected=selected' : ''; ?> ><?php echo ucfirst($callcenter_data[$i]->name); ?></option>
                            <?php } ?>
                        </select>            
                    </div>
                </div>
                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>

                <div class="g_1_4">
                    <label for="af-present">Start Date: </label>
                </div>
                <div class="g_3_4_last">
                    <div class="g_1_3">
                        <input type="text" name="search_startdate" value="<?php echo $_POST['search_startdate']; ?>"  id="datepicker-default_end" class="datepicker" />
                    </div>
                    <div class="g_1_4" style="width:13.5%">
                        &nbsp;&nbsp;&nbsp;<label for="af-present">End Date: </label>
                    </div>
                    <div class="g_1_4">
                        <input type="text" name="search_enddate" value="<?php echo $_POST['search_enddate']; ?>"  id="datepicker-default" class="datepicker" />
                    </div>
                </div>
                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>
                <hr/>
                 <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>
                  <div class="submit-cancel-button">
                    <input type="submit" class="button-text"  value="Delete" name="search_btn" id="search_btn" />
                </div>
                <div class="spacer-15">
                    <!-- spacer 15px -->
                </div>
            </form>
        </div>
    </div>
</div>
</section>
