{
"users" :[
<?php $bol= true; ?>
    <?php foreach ($ad_users as $ad_user): ?>
<?php if($postUser==$ad_user->getAdUserId()):?>
<?php if($bol){
    $bol=false;
}else{
    echo ',';
}
?>
 {
			"id":"<?php echo $ad_user->getUserId() ?>",
                        "lname":"<?php echo $ad_user->getLname(); ?>",
			"fname":"<?php echo $ad_user->getFname(); ?>",
                        "phone":"<?php echo $ad_user->getPhone(); ?>",
                        "email":"<?php echo $ad_user->getEmail(); ?>"
}
<?php endif; ?>
    <?php endforeach; ?>
			]
}
