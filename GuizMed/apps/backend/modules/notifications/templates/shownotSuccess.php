{
   "notification":{
	"id":"<?php echo $ad_notification->getNotificationId(); ?>",
	"patient":{
	   "fName":"<?php echo $ad_notification->getAdPatient()->getFname(); ?>",
	   "lName":"<?php echo $ad_notification->getAdPatient()->getLname(); ?>"
	},
	"user":{
	   "fName":"<?php if($userId==$ad_notification->getOldUser()){echo $ad_notification->getNewUser()->getFname();}else{echo $ad_notification->getOldUser()->getFname();} ?>",
	   "lName":"<?php if($userId==$ad_notification->getOldUser()){echo $ad_notification->getNewUser()->getLname();}else{echo $ad_notification->getOldUser()->getLname();} ?>"
	},
	"accepted":"<?php echo $ad_notification->getAccepted(); ?>",
	"checked":"<?php echo $ad_notification->getChecked(); ?>",
	"date":"<?php echo $ad_notification->getDate(); ?>",
	"reason":"<?php echo $ad_notification->getReason(); ?>"
   }
}