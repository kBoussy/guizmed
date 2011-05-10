{
"prescription" : {

      "id" : "<?php echo $ad_prescription->getAdPrescId() ?>",
      "start_date": "<?php  $datedeel = preg_split('/ /',$ad_prescription->getStartDate()); echo $datedeel[0] ?>",
      "end_date": "<?php $datedeel = preg_split('/ /',$ad_prescription->getEndDate()); echo $datedeel[0] ?>",
      "presc_date": "<?php $datedeel = preg_split('/ /',$ad_prescription->getPrescDate()); echo $datedeel[0] ?>",
      "dose": "<?php echo $ad_prescription->getDose() ?>",
      "med":{
        "id":"<?php echo $ad_prescription->getMedForm()->getMedFormId(); ?>",
        "name":"<?php echo $ad_prescription->getName($ad_prescription->getMedFormId()) ?>"
      },
      "frequency": "<?php echo $ad_prescription->getFrequency() ?>",
      "comment": "<?php echo $ad_prescription->getComment() ?>",
      "stop_date": "<?php $datedeel = preg_split('/ /',$ad_prescription->getStopDate()); echo $datedeel[0] ?>",
      "stop_reason": "<?php $datedeel = preg_split('/ /',$ad_prescription->getStopReason()); echo $datedeel[0] ?>"
}
}