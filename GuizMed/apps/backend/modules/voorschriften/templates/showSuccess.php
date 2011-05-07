{
"prescription" : {
		"id":"<?php echo $ad_prescription->getAdPrescId() ?>",
		"name":"<?php echo $ad_prescription->getName($ad_prescription->getMedFormId()) ?>",
		"dose":"<?php echo $ad_prescription->getDose() ?>",
		"frequency":"<?php echo $ad_prescription->getUserPatientId() ?>",
		"startDate":"<?php echo $ad_prescription->getStartDate() ?>",
		"stopDate":"<?php echo $ad_prescription->getEndDate() ?>",
		"prescDate":"<?php echo $ad_prescription->getPrescDate() ?>"
}
}