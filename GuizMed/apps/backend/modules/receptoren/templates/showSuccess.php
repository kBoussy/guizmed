{
"receptor" : {
		"id":"<?php echo $id; ?>",
		"name":"<?php echo $med_form_bondings[0]->getMedChemBonding()->getName() ?>",
		"meds":[
                <?php $bol = true; ?>
    <?php foreach ($med_form_bondings as $med_form_bonding): ?>
<?php                if($bol == true){
                    $bol = false;
                }else{
                    echo ',';
                } ?>
			{
				"id":"<?php echo $med_form_bonding->getMedFormBondingId() ?>",
				"ki_value":"<?php echo $med_form_bonding->getMedKiVal()->getValue() ?>",
				"influence":"<?php echo $med_form_bonding->getMedKiVal()->getInfluence() ?>",
				"tagval":"<?php echo $med_form_bonding->getMedKiVal()->getTagval() ?>"
			}
    <?php endforeach ?>
		]
}
}







