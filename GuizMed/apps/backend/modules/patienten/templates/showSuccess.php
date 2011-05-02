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






<!--
<table>
  <tbody>
    <tr>
      <th>Patient:</th>
      <td><?php echo $ad_patient->getPatientId() ?></td>
    </tr>
    <tr>
      <th>Fname:</th>
      <td><?php echo $ad_patient->getFname() ?></td>
    </tr>
    <tr>
      <th>Lname:</th>
      <td><?php echo $ad_patient->getLname() ?></td>
    </tr>
    <tr>
      <th>Bdate:</th>
      <td><?php echo $ad_patient->getBdate() ?></td>
    </tr>
    <tr>
      <th>Patient since:</th>
      <td><?php echo $ad_patient->getPatientSince() ?></td>
    </tr>
    <tr>
      <th>Sex:</th>
      <td><?php echo $ad_patient->getSex() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('patienten/edit?patient_id='.$ad_patient->getPatientId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('patienten/index') ?>">List</a>
!>