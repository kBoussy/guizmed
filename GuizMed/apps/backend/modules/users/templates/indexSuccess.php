{
"users" :[
<?php $bol= true; ?>
    <?php foreach ($ad_users as $ad_user): ?>
<?php if($bol){
    $bol=false;
}else{
    echo ',';
}
?>
 {
			"id":"<?php echo $ad_user->getUserId() ?>",
			"name":"<?php echo $ad_user->getFname().' '.$ad_user->getLname() ?>"
}
    <?php endforeach; ?>
			]
}
