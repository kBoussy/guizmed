{
"nonPsycho":[
<?php $bolnon = true; ?>
    <?php foreach ($ad_non_psychos as $ad_non_psycho): ?>
<?php    if($bolnon==true){
    $bolnon = false;
}else{
    echo ',';
}
?>
{
"id" : "<?php echo $ad_non_psycho->getAdNonPsychoId(); ?>",
"name":"<?php echo $ad_non_psycho->getName(); ?>"
}
    <?php endforeach; ?>
]
}