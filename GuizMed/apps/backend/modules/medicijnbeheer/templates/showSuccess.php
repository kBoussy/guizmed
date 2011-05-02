{
    "medicine" : [
        {
            "med_form" : "<?php echo $med_form->getMedFormId() ?>",
            "med_base": "<?php echo $med_form->getMedBaseId() ?>",
            "med_magister form":"<?php echo $med_form->getMedMagisterFormId() ?>",
            "dose":"<?php echo $med_form->getDose() ?>",
            "Bioavailability" : "<?php echo $med_form->getBioavailability() ?>",
            "Proteine binding": "<?php echo $med_form->getProteineBinding() ?>",
            "T_max_h":"<?php echo $med_form->getTMaxH() ?>",
            "Hlf":"<?php echo $med_form->getHlf() ?>",
            "Ddd":"<?php echo $med_form->getDdd() ?>",
            "Dose":"<?php echo $med_form->getDose() ?>"
        }
    ]
}