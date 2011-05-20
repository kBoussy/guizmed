{
    "med_magister3": [
    <?php $bol = true; ?>
    <?php foreach ($med_magister_forms as $med_magister_form): ?>
    <?php if($bol==true){
        $bol =false;
    }else{
        echo ',';
    } ?>
        {
            "id": "<?php echo $med_magister_form->getMedMagisterFormId() ?>",
            "name": "<?php echo $med_magister_form->getNaam() ?>"
        }
    <?php endforeach; ?>
    ]
}