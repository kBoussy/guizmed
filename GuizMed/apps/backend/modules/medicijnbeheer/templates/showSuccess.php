{
    "medicine" : [
    {
    "mainclass" :  "<?php echo $med_base_id->getMainclass(); ?>",
    "gen_name" : "<?php echo $med_base_id->getGenName(); ?>",
    "med_base" : "<?php echo $med_base_id->getSpeciality(); ?>",
    "type": 
    {
        "subtype1":"<?php echo $med_base_id->getMedType()->getMedSubtype1()->getName(); ?>",
        "subtype2":"<?php echo $med_base_id->getMedType()->getMedSubtype2()->getName(); ?>"
        }
        ,
    "submeds":[
            <?php $bol = true?>
    <?php foreach ($med_forms as $med_form): ?>
    <?php if($bol!=true){
        echo ",";
    }?>
    <?php $bol=false ?>
        {
            "med_form" : "<?php echo $med_form->getMedFormId() ?>",
            "med_magister_form":"<?php echo $med_form->getMetMagisterName($med_form->getMedMagisterFormId()) ?>",
            <?php 
            foreach ($med_form->getMedFormBonding() as $medFormBonding){
                echo "\"".preg_replace('/ /','_',$medFormBonding->getMedChemBonding())."\" : \"".$medFormBonding->getMedKiVal()->getValue().' ('.$medFormBonding->getMedKiVal()->getTagval().')'."\",";
            }?>

            "Dose":"<?php echo $med_form->getDose() ?>",
            "Bioavailability" : "<?php echo $med_form->getBioavailability() ?>",
            "Proteine_binding": "<?php echo $med_form->getProteineBinding() ?>",
            "T_max_h":"<?php echo $med_form->getTMaxH() ?>",
            "Hlf":"<?php echo $med_form->getHlf() ?>",
            "Ddd":"<?php echo $med_form->getDdd() ?>",
            "metabolism":[
            <?php $start = true; ?>
                <?php $i=0; foreach($metabolisms as $met): ?>
            <?php if($start == true){
                $start = false;
            }else{
                echo ',';
            }?>
                    "<?php echo $met; ?>"
                    <?php $i++; ?>
            <?php endforeach; ?>
            ],
            "inhibitor":[
            <?php $start = true; $i=0; ?>
                <?php foreach($inhibitor as $met): ?>
            <?php if($start == true){
                $start = false;
            }else{
                echo ',';
            }?>
                    "<?php echo $met; ?>"
                    <?php $i++; ?>
            <?php endforeach; ?>
            ],
            "inducer":[
            <?php $start = true; ?>
                <?php $i=0; foreach($inducer as $met): ?>
            <?php if($start == true){
                $start = false;
            }else{
                echo ',';
            }?>
                    "<?php echo $met; ?>"
                    <?php $i++; ?>
            <?php endforeach; ?>
            ]
        }
    <?php endforeach; ?>
        ]
    }
    ]
}