<?php

/**
 * notifications actions.
 *
 * @package    GuizMed
 * @subpackage notifications
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class notificationsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['userId'])){
		$this->ad_notifications = Doctrine_Core::getTable('AdNotification')
		  ->createQuery('a')
		  ->execute();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }
  public function executeShow(sfWebRequest $request)
  {
    $user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['userId'])){
		$this->incommings = Doctrine_Query::create()->from('AdNotification an')->where('an.new_user_id = ?',$request->getParameter('uId'))->execute();
		$this->outcommings = Doctrine_Query::create()->from('AdNotification an')->where('an.prev_user_id = ?',$request->getParameter('uId'))->execute();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
//    $this->ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id')));
//    $this->forward404Unless($this->ad_notification);
  }
  public function executeShownot(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['userId'])){
		$this->ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id')));
		$this->userId= $request->getParameter('userId');
		$this->forward404Unless($this->ad_notification);
		$log = new AdLog();
		$log->setAction('De gebruiker heeft zijn notifications gecontroleerd.');
		$log->setAdUserId($_POST['userId']);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}	
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AdNotificationForm();
  }
  public function executeAccept(sfWebRequest $request)
  {
      $notification = Doctrine_Core::getTable('AdNotification')->find(array($_POST['notif_id']));
      $notification->setAccepted($_POST['accepted']);
      $notification->save();

      if($notification->getAccepted()==true){
      $ad_user_patient = Doctrine_Query::create()->from('AdUserPatient aup')->where('aup.patient_id= ?',$notification->getPrevUserId())->andWhere('aup.user_id = ?', $notification->getNewUser())->execute();
      $ad_user_patient->setUserId($notification->getNewUserId());
      $ad_user_patient->save();
      }

      $this->redirect('notifications/show/uId/'.$notification->getNotificationId());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $POST_['user_id']=1;
    $POST_['patient_id']=1;

    $not = new AdNotification();
    $not->setNewUserId($POST_['user_id']);
    $not->setPatientId($POST_['patient_id']);
    $not->setPrevUserId($not->getOldDoctorPatient($POST_['patient_id']));
    $not->setDate(date('y-m-d H:m:s'));
    $not->save();

    $this->redirect('notifications/show/uId/'.$not->getNotificationId());
/*    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AdNotificationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id'))), sprintf('Object ad_notification does not exist (%s).', $request->getParameter('notification_id')));
    $this->form = new AdNotificationForm($ad_notification);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id'))), sprintf('Object ad_notification does not exist (%s).', $request->getParameter('notification_id')));
    $this->form = new AdNotificationForm($ad_notification);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id'))), sprintf('Object ad_notification does not exist (%s).', $request->getParameter('notification_id')));
    $ad_notification->delete();

    $this->redirect('notifications/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ad_notification = $form->save();

      $this->redirect('notifications/edit?notification_id='.$ad_notification->getNotificationId());
    }
  }
}
