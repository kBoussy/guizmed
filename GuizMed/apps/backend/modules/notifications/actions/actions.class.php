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
    $this->ad_notifications = Doctrine_Core::getTable('AdNotification')
      ->createQuery('a')
      ->execute();
  }
  public function executeShow(sfWebRequest $request)
  {
      $this->incommings = Doctrine_Query::create()->from('AdNotification an')->where('an.new_user_id = ?',$request->getParameter('uId'))->execute();
      $this->outcommings = Doctrine_Query::create()->from('AdNotification an')->where('an.prev_user_id = ?',$request->getParameter('uId'))->execute();

//    $this->ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id')));
//    $this->forward404Unless($this->ad_notification);
  }
  public function executeShownot(sfWebRequest $request)
  {
    $this->ad_notification = Doctrine_Core::getTable('AdNotification')->find(array($request->getParameter('notification_id')));
    $this->userId= $request->getParameter('userId');
    $this->forward404Unless($this->ad_notification);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AdNotificationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AdNotificationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
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
