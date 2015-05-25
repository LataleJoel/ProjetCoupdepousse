<?php
    defined('__COUPDEPOUCE__') or die('Acces interdit');
        require_once 'framework/helpers/form.helper.php';
    $format=array_merge(array('---'),$this->listeFormations);
 ?>
<section id="aediter_coup_de_pouce">
    <div class="conteneur">
        <fieldset>
            <legend>
                <h2 class="titre">Editer un coup de pouce</h2>
            </legend>
<form method="POST" action="?controller=coup_de_pouce&action=<?php echo $this->action;?>">
    <?php FormHelper::cleCSRF();?>
    <p class="erreur-form"> 
        <?php echo $this->formMessage;?>
    </p>
    <input type="hidden" name="id" value="<?php echo $this->id;?>" />    
    <dl>
        <dt>
            <label for="titre">Titre :</label>
        </dt>
        <dd>
            <input id="titre" name="titre" type="text" value="<?php echo $this->titre;?>"/>
        </dd>
        <dt> </dt>
         <dt>
            <label for="accroche">Accroche:</label>
        </dt>
        <dd>
            <input id="accroche" name="accroche" type="text" value="<?php echo $this->accroche ?>"/>
        </dd>
        <dt>    
        </dt>
        <dt>
            <label for="description">Description :</label>
        </dt>
        <dd>
            <textarea id="description" name="description" type="text" rows="12" cols="50"><?php echo $this->description?></textarea>
        </dd>
        <dt>
            
        </dt>
         <dt>
            <label for="date">Date:</label>
        </dt>
        <dd>
            <text id="date" name="date" placeholder="jj/mm/aaaa hh:mm"  type="text" value="<?php echo $this->date;?>"/>
        </dd>
        <dt>
            
        </dt>
        <dt>
                   <label id='place' for='place'>Place Restante: </label>
           </dt>
                    <dd>
                    <select id='place' name='place'>
                      <?php 
                          for($i=1;$i<=10;$i++){
                             HTMLHelper::option($i,null,'---'); 
                          }
                        ?>                
                    </select>
                        </dd>
                        <dt></dt>
                     <dt>
                        <label id='formation' for='formation'>Formation: </label>
                    </dt>
                    <dd>
                    <select id='formation' name='formation'>
                      <?php foreach($format as $val){
                          
                             HTMLHelper::option($val,null,$format); 
                        
                         }?>                
                    </select>
                        </dd>             
        <dt>
        </dt>
        <dd>
            <button id="envoyer" name="envoyer" type="submit" value="1">Envoyer</button>
        </dd>
    </dl>
</form>
            </fieldset>
    </div>
</section>