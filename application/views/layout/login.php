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

    <title>iTalkGlobal Login</title>
    
	<!-- 
    ***************************************
    DEMO - DEMO - DEMO - DEMO - DEMO - DEMO
    
    This demo is modifyed to perfom 
    better(as our servers anr't that fast)
    Most cusom files are compressed and 
    are not readable.
    ***************************************
    -->
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/mobile/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/mobile/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" href="images/mobile/apple-touch-icon.png" />
    <link rel="shortcut icon" href="images/apple-touch-icon.html" />
    <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and not (-webkit-min-device-pixel-ratio: 2)" href="images/mobile/splash-320x460.png" />
    <link rel="apple-touch-startup-image" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" href="images/mobile/splash-640x920-retina.png" />
    <link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: portrait)" href="images/mobile/splash-768x1004.png" />
    <link rel="apple-touch-startup-image" media="(min-device-width: 768px) and (orientation: landscape)" href="images/mobile/splash-1024x748.png" />
    <link rel="apple-touch-startup-image" media="(min-device-width: 1536px) and (orientation: portrait)" href="images/mobile/splash-1536x2008-retina.png" />
    <link rel="apple-touch-startup-image" media="(min-device-width: 2048px) and (orientation: landscape)" href="images/mobile/splash-2048x1496-retina.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="HandheldFriendly" content="true"/>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	 <?php foreach ($styles as $file => $type)
            echo HTML::style($file, array('media' => $type)), "\n" ?>
            <?php foreach ($scripts as $file)
                echo HTML::script($file), "\n" ?>  
	
    
    <meta name="application-name" content="Elite Admin Skin">
    <meta name="msapplication-tooltip" content="Cross-platform admin skin.">
    <meta name="msapplication-starturl" content="http://themes.creativemilk.net/elite/html/index.html">
    <meta name="msapplication-task" content="name=Home;action-uri=http://themes.creativemilk.net/elite/html/index.html;icon-uri=http://themes.creativemilk.net/elite/html/images/favicons/favicon.ico">
    <meta http-equiv="cleartype" content="on" /> 
    
    <!--[if lt IE 8]>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
    <![endif]-->
            



	<!--[if IE 7]>
	<link rel="stylesheet" href="css/destroy-ie6-ie7.css"/>
    <![endif]-->
    
    <link rel="shortcut icon" href="images/favicons/favicon.ico">
  
    <style>
 .watermark{
     background-image: url('<?php echo Kohana::$base_url; ?>images/BG-Watermark.png');
  repeat: no-repeat;
  opacity: 10;
  position: relative;
  bottom: 0;
  float: left;
  }
   </style>
                
</head>
<body class="watermark">  
 
    <!-- this part can be removed, its just here 
         to let you switch between styles and layout sizes -->
    <!--<div id="e-styleswitcher">
        <div class="e-styleswitcher-inner">
            <div class="e-styleswitcher-arrow"><img src="<?php echo Kohana::$base_url; ?>images/icons/plix-16/white/arrow-right-16.png" alt="" /></div>
            <div class="box">
            	<h4>Styles</h4>
                <select id="choose-styling">
                	<option value="strangeblue">Strange blue</option>
                    <option value="black">Black</option>
                    <option value="darkblue">Dark blue</option>
                    <option value="lightgrey">Light grey</option>
                </select>
            </div>    
            <div class="box">
            	<h4>Layout sizes</h4>                
                <select id="set-layout-size">
                	<option value="layout_fluid">fluid</option>
                    <option value="layout_768">768</option>
                    <option value="layout_960">960</option>
                    <option value="layout_1024">1024</option>
                    <option value="layout_1200">1200</option>
                    <option value="layout_1600">1600</option>
                </select>
            </div> 
            <div class="box">
            	<h4>Responsive</h4>                
                <select id="set-layout-responsive">
                	<option value="layout_responsive">yes</option>
                    <option value="">no</option>
                </select>
            </div>
            <div class="box">
            	<h4>Get theme</h4>                
                <select id="get-theme">
                	<option value="">no</option>
                    <option value="yes">yes</option>
                </select>
            </div>                         
        </div>
    </div>-->
 
    <div id="login">
    
    	<!-- Put your logo here -->
    	<div id="logo">
        	<img alt="iTalkGlobal" src="<?php echo Kohana::$base_url; ?>images/italk-logo.png">
        </div>
		<!-- The main part -->                   
		<?php echo $content;?>
        

        
        <!-- place your copyright text here -->
        <footer id="footer">
        	Copyright &copy; 2009 iTalkGlobal
        </footer> 
    </div><!-- End "#login" -->        
</body>
</html>