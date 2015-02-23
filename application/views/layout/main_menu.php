<script>
    function formHandler(){
        var istrue = confirm('Do you want to submit the form?');
        if(istrue == true){
            var e = document.getElementsByName("select_client");
            var strclient =e[0].options[e[0].selectedIndex].value;
            var strclient_txt = e[0].options[e[0].selectedIndex].text;

            document.getElementById("selectedclient").value = strclient;
            document.getElementById("selectedclient_text").value = strclient_txt;
            document.tbl_leads_submit.submit();
        }else{
            return false;
        }
    }
</script>
<nav id="main-menu">
    <?php $user_role = Auth::instance()->get_user()->role_id; ?>

    <?php if ($user_role == 1) { ?>
        <ul>
            <li class="page-active"><a href="<?php echo Kohana::$base_url; ?>dashboard"><span class="home-16 plix-16"></span> Dashboard</a></li>
            <li><a href="<?php echo Kohana::$base_url; ?>submitlead"><span class="home-16 plix-16"></span> Assign Lead</a></li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Upload Data.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>uploaddata">Upload Data</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>uploaddata/uploadforagent">Upload Data for Agent</a></li>
                </ul> 
            </li>
           <!-- <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Agent Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="doc-accordion.html">View Agent</a></li> 
                    <li><a href="doc-breadcrumbs.html">Add Agent</a></li>
                    <li><a href="doc-buttons.html">Agent Target</a></li>
                </ul> 
            </li>-->

            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>User Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>user/view">View User</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>user/add">Add User</a></li>

                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Client Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>client/viewclient">View Client</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>client/add">Add Client</a></li>
                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>CallCenter Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>callcenter/viewcallcenter">View Callcenter</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>callcenter/add">Add Callcenter</a></li>
                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Zipcode Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>zip/add">Add Zipcode</a></li>
                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Make Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>make/view">View Make</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>make/add">Add Make</a></li>

                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Model Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>model/view">View Model</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>model/add">Add Model</a></li>

                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Trim Mgnt.<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>trim/view">View Trim</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>trim/add">Add Trim</a></li>

                </ul> 
            </li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Reports<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>report/leadsales">Revenue Report</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>submitlead/list/report">Leads Report</a></li>
                </ul> 
            </li>

            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Bulk Delete<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>

                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>bulkdelete/delete">Bulk Delete Leads for Admin</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>bulkdelete/delete">Bulk Delete Leads for Agent</a></li> 
                </ul> 
            </li>           
            
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Assign Admin Rights<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>assignrights">Assign Admin Rights</a></li> 
                </ul> 
            </li>


        </ul>
    <?php }
    if ($user_role == 3) {
        ?>
        <ul>
            <li><a href="<?php echo Kohana::$base_url; ?>submitlead"><span class="notebook-16 plix-16"></span>Report of Sales Lead</a>
            </li>
        </ul>
<?php }if ($user_role == 2) { ?>
        <ul>
            <li class="page-active"><a href="<?php echo Kohana::$base_url; ?>dashboard"><span class="home-16 plix-16"></span>Dashboard</a></li>
            <li class="no-mobile"><a href="javascript:void(0);"><span class="note-16 plix-16"></span>Lead Type<span class="button-icon"><span class="plus-10 plix-10"></span></span></a>
                <ul>
                    <li><a href="<?php echo Kohana::$base_url; ?>foragent">New PayDay</a></li> 
                    <li><a href="<?php echo Kohana::$base_url; ?>foragent/auto">Auto</a></li>
                    <li><a href="<?php echo Kohana::$base_url; ?>foragent/new">New Car</a></li>
                    <li><a href="<?php echo Kohana::$base_url; ?>foragent/payday">Payday</a></li>
                    <li><a href="<?php echo Kohana::$base_url; ?>foragent/insurance">Auto Insurance</a></li>
					<li><a href="<?php echo Kohana::$base_url; ?>foragent/diabitic">Diabitic PI</a></li>

                </ul> 
            </li>
        </ul>
<?php } ?>
</nav>  
</aside>

<!-- sidebar meta stats -->

<div id="divBottomLeft" >
    <div id="sidebar-meta">


    </div> 
</div>

