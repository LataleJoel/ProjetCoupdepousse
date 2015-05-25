<?php 
defined('__FRAMEWORK3IL__')or die('Access Interdit');
$trace=$this->getTrace();
?>
 <!DOCTYPE html>
    <html>
       
    <head>
        <title> erreur dans l'application </title>>       
        <meta charset="UTF-8">
    </head>
    <body>
        <h1> ERREUR dans l'application</h1> 
         <p1><?php echo $this->message;?> </p1>
         <p1>Fichier : <?php echo $this->file;?> </p1>
         <p1>Ligne : <?php echo $this->line ;?> </p1>
         <?php if(count($trace)>0):?>
         <p1> Fichier : <?php $trace[0]['class'].'::'.$trace[0]['function'];?> </p1>
         <pre> <?php echo $this->getTraceAsString();?> </pre>
         <?php endif; ?>
               
      </body>
        </html>
