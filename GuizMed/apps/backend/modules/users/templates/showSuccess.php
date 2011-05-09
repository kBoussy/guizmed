{
"user" : {
		"id":"<?php echo $ad_user->getUserId() ?>",
		"fName":"<?php echo $ad_user->getFname() ?>",
		"lName":"<?php echo $ad_user->getLname() ?>",
		"email":"<?php echo $ad_user->getEmail() ?>",
		"phone":"<?php echo $ad_user->getPhone() ?>",
		"function":"<?php echo $ad_user->getAdFunctionId() ?>",
		"role":"<?php echo $ad_user->getAdRole()->getName() ?>"
}
}