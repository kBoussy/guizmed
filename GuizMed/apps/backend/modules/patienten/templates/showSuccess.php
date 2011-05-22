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
            <?php $bolMeds = true; ?>
            <?php foreach($medsActive as $medsA): ?>
            <?php if($bolMeds==true){
                $bolMeds=false;
            }else{
                echo ',';
            }

            ?>
            {   "id":"<?php echo $medsA->getMedFormId(); ?>",
                "pres_id":"<?php echo $medsA->getAdPrescId(); ?>",
                "name":"<?php echo $medsA->getMedForm()->getMedBaseId()->getSpeciality(); ?>",
                "start_date":"<?php echo $medsA->getStartDate(); ?>",
                "end_date":"<?php echo $medsA->getEndDate(); ?>",
                "stop_date":"<?php echo $medsA->getStopDate(); ?>"}
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