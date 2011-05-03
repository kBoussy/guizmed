{
    "medicine" : [
        {
            <?php $bol = true?>
    <?php foreach ($med_forms as $med_form): ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>
            "med_form" : "<?php echo $med_form->getMedFormId() ?>",
            "med_base": "<?php echo $med_form->getMedBaseId() ?>",
            "med_magister_form":"<?php echo $med_form->getMetMagisterName($med_form->getMedMagisterFormId()) ?>",
            "Dose":"<?php echo $med_form->getDose() ?>",
            "Bioavailability" : "<?php echo $med_form->getBioavailability() ?>",
            "Proteine_binding": "<?php echo $med_form->getProteineBinding() ?>",
            "T_max_h":"<?php echo $med_form->getTMaxH() ?>",
            "Hlf":"<?php echo $med_form->getHlf() ?>",
            "Ddd":"<?php echo $med_form->getDdd() ?>",
        }
    <?php endforeach; ?>
    ]
}