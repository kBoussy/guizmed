{
   "ki":[
   <?php $bol = true; ?>
      <?php foreach ($med_ki_vals as $med_ki_val): ?>
   <?php if ($bol == true){
       $bol = false;
   }else{
       echo ',';
   }
   ?>
   {
	"id":"<?php echo $med_ki_val->getMedKiValId(); ?>",
	"value":"<?php echo $med_ki_val->getValue() ?>",
	"tagval":"<?php echo $med_ki_val->getTagval() ?>"
   }
   <?php endforeach; ?>]
}