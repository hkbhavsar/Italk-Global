<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="ie ie6 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 7]>     <html class="ie ie7 lte9 lte8 lte7 no-js"> <![endif]-->
<!--[if IE 8]>     <html class="ie ie8 lte9 lte8 no-js">      <![endif]-->
<!--[if IE 9]>     <html class="ie ie9 lte9 no-js">           <![endif]-->
<!--[if gt IE 9]>  <html class="no-js">                       <![endif]-->
<!--[if !IE]><!--> <html class="no-js">                       <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>iTalkGlobal - A Powerfull Responsive Admin</title>



        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Kohana::$base_url; ?>images/mobile/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Kohana::$base_url; ?>images/mobile/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" href="<?php echo Kohana::$base_url; ?>images/mobile/apple-touch-icon.png" />
        <link rel="shortcut icon" href="<?php echo Kohana::$base_url; ?>images/apple-touch-icon.html" />
        <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and not (-webkit-min-device-pixel-ratio: 2)" href="<?php echo Kohana::$base_url; ?>images/mobile/splash-320x460.png" />
        <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="<?php echo Kohana::$base_url; ?>images/mobile/splash-640x920-retina.png" />
        <link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: portrait)" href="<?php echo Kohana::$base_url; ?>images/mobile/splash-768x1004.png" />
        <link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: landscape)" href="<?php echo Kohana::$base_url; ?>images/mobile/splash-1024x748.png" />
        <link rel="apple-touch-startup-image" media="(min-device-width: 1536px) and (orientation: portrait)" href="<?php echo Kohana::$base_url; ?>images/mobile/splash-1536x2008-retina.png" />
        <link rel="apple-touch-startup-image" media="(min-device-width: 2048px) and (orientation: landscape)" href="<?php echo Kohana::$base_url; ?>images/mobile/splash-2048x1496-retina.png" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="HandheldFriendly" content="true"/>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
        <script src="<?php echo Kohana::$base_url; ?>js/mobiledevices.js"></script>

        <meta name="application-name" content="Elite Admin Skin">
        <meta name="msapplication-tooltip" content="Cross-platform admin skin.">
        <meta name="msapplication-starturl" content="http://themes.creativemilk.net/elite/html/index.html">
        <meta name="msapplication-task" content="name=Home;action-uri=http://themes.creativemilk.net/elite/html/index.html;icon-uri=http://themes.creativemilk.net/elite/html/images/favicons/favicon.ico">
        <meta http-equiv="cleartype" content="on" /> 

        <!--[if lt IE 8]>
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="<?php echo Kohana::$base_url; ?>css/framework.css"/>
        <link rel="stylesheet" href="<?php echo Kohana::$base_url; ?>css/style.css"/>
        <link rel="stylesheet" href="<?php echo Kohana::$base_url; ?>css/ui/jquery.ui.base.css"/>
        <link rel="stylesheet" href="<?php echo Kohana::$base_url; ?>css/theme/darkblue.css" id="themesheet"/>
        <!--[if IE 7]>
        <link rel="stylesheet" href="<?php echo Kohana::$base_url; ?>css/destroy-ie6-ie7.css"/>
    <![endif]-->  
        <!--[if gt IE 7]>
        <link rel="stylesheet" href="<?php echo Kohana::$base_url; ?>css/ie.css"/>
    <![endif]-->

        <link rel="shortcut icon" href="<?php echo Kohana::$base_url; ?>images/favicons/favicon.ico" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>!window.jQuery && document.write('<script src="<?php echo Kohana::$base_url; ?>js/jquery-1.7.2.min.js"><\/script>')</script>
        <script src="http://code.jquery.com/ui/1.8.22/jquery-ui.min.js"></script>
        <script>!window.jQueryUI && document.write('<script src="<?php echo Kohana::$base_url; ?>js/jquery-ui-1.8.22.min.js"><\/script>')</script>
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.mousewheel.min.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.ui.spinner.js"></script>            
        <script src="<?php echo Kohana::$base_url; ?>js/tipsy.js"></script>                       
        <script src="<?php echo Kohana::$base_url; ?>js/treeview.js"></script>                      
        <script src="<?php echo Kohana::$base_url; ?>js/fullcalendar.min.js"></script>               
        <script src="<?php echo Kohana::$base_url; ?>js/selectToUISlider.jQuery.js"></script>       
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.contextMenu.js"></script>            
        <script src="<?php echo Kohana::$base_url; ?>js/elfinder.min.js"></script>                  
        <script src="<?php echo Kohana::$base_url; ?>js/autogrow-textarea.js"></script>              
        <script src="<?php echo Kohana::$base_url; ?>js/textarearesizer.min.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>wysiwyghtml5/parser_rules/advanced.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>wysiwyghtml5/dist/wysihtml5-0.3.0.js"></script>                    
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.colorbox-min.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.dataTables.min.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>js/jquery.maskedinput-1.3.min.js"></script> 
        <script src="<?php echo Kohana::$base_url; ?>js/json2.js"></script>
        <script src="<?php echo Kohana::$base_url; ?>audiojs/audiojs/audio.min.js"></script> 
        <script src="<?php echo Kohana::$base_url; ?>js/e_styleswitcher.1.0.min.js"></script>                 
        <script src="<?php echo Kohana::$base_url; ?>js/main.js"></script>

        <!-- // HTML5/CSS3 support // -->

        <script src="<?php echo Kohana::$base_url; ?>js/modernizr.min.js"></script>

        <script type="text/javascript" src="<?php echo Kohana::$base_url; ?>js/bumpbox/jquery-1.4.1.min.js"></script>
    <!--<script type="text/javascript" src="bumpbox/jquery.easing.1.3.js"></script> Not needed if using standard easing (swing or linear)-->
        <script type="text/javascript" src="<?php echo Kohana::$base_url; ?>js/bumpbox/tools.flashembed-1.0.4.min.js"></script>
        <script type="text/javascript" src="<?php echo Kohana::$base_url; ?>js/bumpbox/flowplayer-3.1.4.min.js"></script>
        <script type="text/javascript" src="<?php echo Kohana::$base_url; ?>js/bumpbox/bumpbox.js"></script>

    </head>
    <body class="layout_fluid"> 
        <input type="hidden" value="<?php echo Kohana::$base_url; ?>" name="base_url" id="base_url"/>
        <!-- this part can be removed, its just here 
             to let you switch between styles and layout sizes -->


        <div id="container">
       <!-- CONTENT -->
        
               
                     <!-- CONTENT HEADER -->
                   
                       <!-- CONTENT -->
                       <div id="content-main">
                            <div id="content-main-inner">
                                <?php echo $content; ?>
                            </div>
                        </div><!-- End #content-main --> 
                    <!-- CONTENT FOOTER -->
              
           

       

        <!-- scroll to top link -->
        <div id="scrolltotop"><span></span></div> 

    </body>
</html>