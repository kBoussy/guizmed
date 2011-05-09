















{
"prescription" : {

      "id" : "<?php echo $ad_prescription->getAdPrescId() ?>",
      "name":"<?php echo $ad_prescription->getName($ad_prescription->getMedFormId()) ?>",
      "start_date": "<?php echo $ad_prescription->getStartDate() ?>",
      "end_date": "<?php echo $ad_prescription->getEndDate() ?>",
      "presc_date": "<?php echo $ad_prescription->getPrescDate() ?>",
      "dose": "<?php echo $ad_prescription->getDose() ?>",
      "med":{
        "id":"<?php echo $ad_prescription->getMedForm()->getMedFormId(); ?>",
        "name":"<?php echo $ad_prescription->getMedForm()->getMedBaseId()->getMainclass(); ?>"
      },
      "frequency": "<?php echo $ad_prescription->getFrequency() ?>",
      "comment": "<?php echo $ad_prescription->getComment() ?>",
      "stop_date": "<?php echo $ad_prescription->getStopDate() ?>",
      "stop_reason": "<?php echo $ad_prescription->getStopReason() ?>"
}
}