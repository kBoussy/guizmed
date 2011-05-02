{    "patient" : [
        {
            "personalInfo": {
                "id" : "<?php echo $ad_patient->getPatientId() ?>",
                "fName": "<?php echo $ad_patient->getFname() ?>",
                "lName": "<?php echo $ad_patient->getLname() ?>",
                "sex": "<?php echo $ad_patient->getSex() ?>",
                "Bdate": "<?php echo $ad_patient->getBdate() ?>",
                "patient_since": "<?php echo $ad_patient->getPatientSince() ?>"
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
      "startDate": "<?php echo $ad_prescription->getStartDate() ?>",
      "endDate": "<?php echo $ad_prescription->getEndDate() ?>",
      "prescDate": "<?php echo $ad_prescription->getPrescDate() ?>",
      "dose": "<?php echo $ad_prescription->getDose() ?>",
      "frequency": "<?php echo $ad_prescription->getFrequency() ?>",
      "medFormId": "<?php echo $ad_prescription->getMedFormId() ?>",
      "comment": "<?php echo $ad_prescription->getComment() ?>",
      "stopDate": "<?php echo $ad_prescription->getStopDate() ?>",
      "stopReason": "<?php echo $ad_prescription->getStopReason() ?>"
}



    <?php endforeach; ?>
            ]
        }
    ]
}