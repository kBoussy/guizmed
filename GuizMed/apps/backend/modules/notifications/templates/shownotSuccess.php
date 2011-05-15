{
   "notification":{
	"id":"<?php echo $ad_notification->getNotificationId(); ?>",
	"patient":{
	   "fName":"<?php echo $ad_notification->getAdPatient()->getFname(); ?>",
	   "lName":"<?php echo $ad_notification->getAdPatient()->getLname(); ?>"
	},
	"user":{
	   "fName":"<?php echo $ad_notification->getAdUser()->getFname(); ?>",
	   "lName":"<?php echo $ad_notification->getAdUser()->getLname(); ?>"
	},
	"accepted":"<?php echo $ad_notification->getAccepted(); ?>",
	"checked":"<?php echo $ad_notification->getChecked(); ?>",
	"date":"<?php echo $ad_notification->getDate(); ?>",
	"reason":"<?php echo $ad_notification->getReason(); ?>"
   }
}