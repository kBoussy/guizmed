{
"receptors":[
<?php $bol = true; ?>
    <?php foreach ($med_chem_bondings as $med_chem_bonding): ?>
<?php if($bol == true){
    $bol = false;
}else{
    echo ',';
} ?>
{
"id" : "<?php echo $med_chem_bonding->getChemBondingId() ?>",
"name":"<?php echo $med_chem_bonding->getName() ?>"
}
    <?php endforeach; ?>
]
}