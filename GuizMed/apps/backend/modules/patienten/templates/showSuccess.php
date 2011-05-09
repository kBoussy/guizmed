{    "patient" : [
        {
            "personalInfo": {
                "id" : "<?php echo $ad_patient->getPatientId() ?>",
                "fName": "<?php echo $ad_patient->getFname() ?>",
                "lName": "<?php echo $ad_patient->getLname() ?>",
                "bDate": "<?php echo $ad_patient->getBdate() ?>",
                "since": "<?php echo $ad_patient->getPatientSince() ?>",
                "sex": "<?php echo $ad_patient->getSex() ?>"
            },
            "prescriptions" : [

    <?php $bol = true?>
    <?php foreach ($prescriptions as $ad_prescription): ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>

 {
      "id" : "<?php echo $ad_prescription->getAdPrescId() ?>",
      "start_date": "<?php echo $ad_prescription->getStartDate() ?>",
      "end_date": "<?php echo $ad_prescription->getEndDate() ?>",
      "med":{
        "id":"<?php echo $ad_prescription->getMedForm()->getMedFormId(); ?>",
        "name":"<?php echo $ad_prescription->getMedForm()->getMedBaseId()->getSpeciality(); ?>"
      },
      "stop_date": "<?php echo $ad_prescription->getStopDate() ?>"
}
    <?php endforeach; ?>
            ],
            "non_psycho": [
    <?php $bolNonPharma = true; ?>
    <?php foreach($nonPsychos as $nonPsycho): ?>
    <?php if($bolNonPharma==true){
        $bolNonPharma = false;
    }else{
        echo ',';
    } ?>
	{
		"id":"<?php echo $nonPsycho->getNonPsychoPatId() ?>",
		"name":"<?php echo $nonPsycho->getAdNonPsycho()->getName() ?>",
		"start_date":"<?php echo $nonPsycho->getStartDate() ?>",
		"stop_date":"<?php echo $nonPsycho->getStopDate() ?>"
	}
   <?php endforeach; ?>
]
        }
    ]
}