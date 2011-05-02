{
    "allMedicines" : [
    <?php $bol = true?>
    <?php foreach ($medicaties as $medicatie): ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>
    {
            "id" : "<?php echo $medicatie->getMedBaseId() ?>",
            "mainclass": "<?php echo $medicatie->getMainclass(); ?>",
            "gen_name": "<?php echo $medicatie->getGenName(); ?>",
            "speciality": "<?php echo $medicatie->getSpeciality(); ?>",
            "med_type_id": "<?php echo $medicatie->getMedTypeId(); ?>"
        }

    <?php endforeach; ?>
    ]
}


