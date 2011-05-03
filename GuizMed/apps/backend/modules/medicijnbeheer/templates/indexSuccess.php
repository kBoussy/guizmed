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
            "speciality": "<?php echo $medicatie->getSpeciality(); ?>",
        }

    <?php endforeach; ?>
    ]
}


