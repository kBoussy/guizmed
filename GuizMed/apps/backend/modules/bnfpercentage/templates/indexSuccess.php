{
    "bnf_percentages": [
    <?php $bol = true; ?>
    <?php foreach ($med_bnf_percentages as $med_bnf_percentage): ?>
    <?php if($bol ==true){
        $bol = false;
    }else{
        echo ',';
    } ?>
        {
            "id": "<?php echo $med_bnf_percentage->getBnfPercentageId() ?>",
            "name": "<?php echo $med_bnf_percentage->getPercentage() ?>"
        }
    <?php endforeach; ?>
    ]
}