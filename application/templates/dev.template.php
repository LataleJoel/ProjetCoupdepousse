<?php
defined('__COUPDEPOUCE__')or die('Access Interdit');
?>
<!DOCTYPE html>
<html>
       
    <head>
        <title>coup de pouce</title>       
        <meta charset="UTF-8">
              <link rel="stylesheet"  MEDIA="screen" TYPE="text/css" href="styles/reset.css" > 
        <link rel="stylesheet"  MEDIA="screen" TYPE="text/css" href="styles/coupsdepousse.css" > 
    </head>
     
    <body>  
    <h1> Template : <?php echo basename(__FILE__);?> </h1>
            <?php Page::afficherVue();?>              
      </body>
    <hr>
    <h3>Page </h3>
    <pre><?php print_r(Application::getPage());?></pre>
    <h3>POST</h3>
    <pre><?php print_r($_POST);?></pre>
   
        </html>

