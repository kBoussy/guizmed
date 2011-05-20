{
    "patienten": [
    <?php $bol = true?>
    <?php foreach ($ad_patients as $ad_patient): ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>
		{
			"personalInfo": {
				"id": "<?php echo $ad_patient->getPatientId(); ?>",
				"fName": "<?php echo $ad_patient->getFname(); ?>",
				"lName": "<?php echo $ad_patient->getLname(); ?>",
				"bDate": "<?php echo $ad_patient->getBdate(); ?>",
				"since": "<?php echo $ad_patient->getPatientSince(); ?>",
				"sex": "<?php echo $ad_patient->getSex(); ?>"
			},
			"doctors": [
			<?php $docbol = true; ?>
			<?php foreach($ad_patient->getAduserpatients() as $adUserPatient): ?>
			<?php if($docbol ==true){
				$docbol=false;
			}else{
				echo ',';
			} ?>
				{
					"id": "<?php $adUserPatient->getAdUser()->getUserId(); ?>",
					"lName": "<?php $adUserPatient->getAdUser()->getLname(); ?>",
					"fName": "<?php $adUserPatient->getAdUser()->getFname(); ?>"
				}
			<?php endforeach; ?>
			]
		}
        <?php endforeach; ?>
    ]
}