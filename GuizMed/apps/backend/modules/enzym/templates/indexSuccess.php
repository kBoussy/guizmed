{
    "enzymes": [
    <?php $bol = true; ?>
    <?php foreach ($int_enzyms as $int_enzym): ?>
    <?php if($bol == true){
        $bol = false;
    }else{
        echo ',';
    } ?>
        {
            "id": "<?php echo $int_enzym->getIntEnzymId() ?>",
            "name": "<?php echo $int_enzym->getName() ?>"
        }
    <?php endforeach; ?>
    ]
}