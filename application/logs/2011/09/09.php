<?php defined('SYSPATH') or die('No direct script access.'); ?>

2011-09-09 11:17:09 --- ERROR: Kohana_Request_Exception [ 0 ]: Unable to find a route to match the URI: auth/.lib/css/img/orange/logo-login.png ~ SYSPATH\classes\kohana\request.php [ 676 ]
2011-09-09 15:56:27 --- ERROR: Database_Exception [ 1051 ]: Unknown table 'prospects1' [ SELECT `prospects1`.*, `prospects`.* FROM `prospects` LEFT JOIN `users` ON (`prospects`.`id` = `users`.`prospect_id`) WHERE `prospects`.`user_id` = '27' AND `prospects`.`binary_side` = 'left' ORDER BY `users`.`parent_id` DESC ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 179 ]
2011-09-09 16:25:14 --- ERROR: ErrorException [ 1 ]: Call to a member function limit() on a non-object ~ APPPATH\classes\model\geneology.php [ 39 ]
2011-09-09 16:25:29 --- ERROR: ErrorException [ 1 ]: Call to a member function limit() on a non-object ~ APPPATH\classes\model\geneology.php [ 46 ]