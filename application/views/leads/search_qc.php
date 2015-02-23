<?php if ($_POST['action_frm'] != '') { ?>
    <div class="dialog error">
        <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Deleted Successfully</p>
        <span>x</span>
    </div>
<?php } ?>

<?php if ($_POST['delete_all_msg'] != '') { ?>
    <div class="dialog error">
        <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Deleted Successfully</p>
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
                        <option value="payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'payday' ? 'selected=selected' : ''; ?>>Payday</option>
                        <option value="insurance" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'insurance' ? 'selected=selected' : ''; ?>>Insurance Auto </option>
                        <option value="credit_repair" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign'] == 'credit_repair' ? 'selected=selected' : ''; ?>>Credit Repair</option>
                    </select>
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

                <div class="g_1_4">
                    <label for="af-present">Agent: </label>
                </div>
                <div class="g_3_4_last">
                    <div class="g_1_4">
                        <select name="search_agent">
                            <option value="">-- select option --</option>
                            <?php for ($i = 0; $i < count($userData); $i++) { ?>
                                <option value="<?php echo $userData[$i]->id; ?>" <?php echo isset($_POST['search_agent']) && $_POST['search_agent'] == $userData[$i]->id ? 'selected=selected' : ''; ?> ><?php echo ucfirst($userData[$i]->first_name); ?></option>
                            <?php } ?>
                        </select>            
                    </div>
                </div>
                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>

               
                <div class="g_1_4">
                    <label for="af-present">Search in: *</label>
                </div>
                <div class="g_1_4">
                    <select name="search_searchin" id="search-searchin">
                        <option value="">--- Select ---</option>
                        <option value="fname" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin'] == 'fname' ? 'selected=selected' : ''; ?>>Name</option>
                        <option value="phone" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin'] == 'phone' ? 'selected=selected' : ''; ?>>Phone</option>
                        <option value="ssn" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin'] == 'ssn' ? 'selected=selected' : ''; ?>>SSN</option>
                        <option value="email" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin'] == 'email' ? 'selected=selected' : ''; ?>>Email</option>
                    </select>
                </div>
                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>
                <div class="g_1_4">
                    <label for="s-field-1">Keyword(s):</label>
                </div>
                <div class="g_1_4">
                    <input type="text" name="search_keyword" id="s-field-1" value="<?php echo $_POST['search_keyword']; ?>"/>
                </div>

                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>
                <hr/>


                <div class="spacer-20">
                    <!-- spacer 20px -->
                </div>
                <input type="hidden" id="sbt_frm" name="sbt_frm">
                <input type="hidden" id="action_frm" name="action_frm">
                <input type="hidden" id="delete_all" name="delete_all">
                <input type="hidden" id="delete_all_msg" name="delete_all_msg">
                <input type="hidden" name="lead_type" id="lead_type" value="<?php echo $lead_type; ?>" />

                <div class="submit-cancel-button">
                    <input type="submit" class="button-text"  value="Search now" name="search_btn" id="search_btn" />
                    </div>
                <div class="spacer-15">
                    <!-- spacer 15px -->
                </div>
            </form>
        </div>
    </div>
</div>