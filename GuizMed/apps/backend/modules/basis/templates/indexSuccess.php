{
    "allMedicines" : [
    <?php $bol = true?>
    <?php foreach ($med_base_ids as $med_base_id): ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>
    {
            "id" : "<?php echo $med_base_id->getMedBaseId() ?>",
            "generic_name" : "<?php echo $med_base_id->getGenName() ?>",
            "speciality" : "<?php echo $med_base_id->getSpeciality() ?>",
            "id" : "<?php echo $med_base_id->getMedTypeId() ?>",
            "mainclass": "<?php echo $med_base_id->getMainclass(); ?>"
        }

    <?php endforeach; ?>
    ]
}