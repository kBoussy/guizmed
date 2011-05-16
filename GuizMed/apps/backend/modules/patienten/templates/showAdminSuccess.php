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

    <?php $bol = true;
        $medsActive = array();
    ?>
    <?php foreach ($prescriptions as $ad_prescription): ?>

            <?php if($ad_prescription->getStopDate()!="" || $ad_prescription->getEndDate()<date('y-m-d H:m:s')){
                    if(""==""){ //check halfleeftijd
                        array_push($medsActive,$ad_prescription);
                    }
            }

                    ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>

 {
      "id" : "<?php echo $ad_prescription->getAdPrescId() ?>",
      "start_date": "<?php $datedeel = preg_split('/ /',$ad_prescription->getStartDate()); echo $datedeel[0] ?>",
      "end_date": "<?php $datedeel = preg_split('/ /',$ad_prescription->getEndDate()); echo $datedeel[0]  ?>",
      "med":{
        "id":"<?php echo $ad_prescription->getMedForm()->getMedFormId(); ?>",
        "name":"<?php echo $ad_prescription->getMedForm()->getMedBaseId()->getSpeciality(); ?>"
      },
      "stop_date": "<?php echo $ad_prescription->getStopDate() ?>"
}
    <?php endforeach; ?>
            ],
            "meds": [
            <?php foreach($medsActive as $medsA): ?>
                "id":"<?php $medsA->getMedFromId(); ?>",
                "pres_id":"<?php $medsA->getAdPresId(); ?>",
                "name":"<?php $medsA->getMedForm()->getMedBaseId()->getSpeciality(); ?>",
                "start_date":"<?php $medsA->getStartDate(); ?>",
                "end_date":"<?php $medsA->getEndDate(); ?>",
                "stop_date":"<?php $medsA->getStopDate(); ?>"
            <?php endforeach; ?>
            ],



	    "doctors":[
            <?php $doctorbol = true; ?>
            <?php foreach($ad_patient->getAdUserPatient() as $ad_user): ?>
            <?php if ($doctorbol == true){
                $doctorbol = false;
            }else{
                echo ',';
            } ?>
		{
		   "id":"<?php echo $ad_user->getAdUser()->getUserId(); ?>",
		   "lName":"<?php echo $ad_user->getAdUser()->getLName(); ?>",
		   "fName":"<?php echo $ad_user->getAdUser()->getFName(); ?>"
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
		"start_date":"<?php $datedeel = preg_split('/ /',$nonPsycho->getStartDate()); echo $datedeel[0] ?>",
		"stop_date":"<?php $datedeel = preg_split('/ /',$nonPsycho->getStopDate()); echo $datedeel[0] ?>"
	}
   <?php endforeach; ?>
]
        }
    ]
}