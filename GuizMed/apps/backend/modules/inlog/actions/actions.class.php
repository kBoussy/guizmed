<?php

/**
 * inlog actions.
 *
 * @package    GuizMed
 * @subpackage inlog
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inlogActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ad_users = Doctrine_Core::getTable('adUser')
      ->createQuery('a')
      ->execute();
  }
  public function executeShow(sfWebRequest $request)
  {
    $this->ad_user = Doctrine_Core::getTable('adUser')->find(array($request->getParameter('user_id')));
    $this->forward404Unless($this->ad_user);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new adUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new adUserForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ad_user = Doctrine_Core::getTable('adUser')->find(array($request->getParameter('user_id'))), sprintf('Object ad_user does not exist (%s).', $request->getParameter('user_id')));
    $this->form = new adUserForm($ad_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ad_user = Doctrine_Core::getTable('adUser')->find(array($request->getParameter('user_id'))), sprintf('Object ad_user does not exist (%s).', $request->getParameter('user_id')));
    $this->form = new adUserForm($ad_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ad_user = Doctrine_Core::getTable('adUser')->find(array($request->getParameter('user_id'))), sprintf('Object ad_user does not exist (%s).', $request->getParameter('user_id')));
    $ad_user->delete();

    $this->redirect('inlog/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ad_user = $form->save();

      $this->redirect('inlog/edit?user_id='.$ad_user->getUserId());
    }
  }
    public function executeInlog(sfWebRequest $request)
      {
		$uName= $_POST['uName'];//$request->getParameter('uName');
		$pWord = $_POST['pWord']; //$request->getParameter('pWord');
		$user = new AdUser();
		$this->inlog = $user->inlog($uName,$pWord);
		$this->userId = $user->getUserId();
		$log = new AdLog();
		$log->setAction('De gebruiker heeft zich ingelogd.');
		$log->setAdUserId($user->getUserId());
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
      }
    public function executeUnlock(sfWebRequest $request)
      {
		$user = new AdUser();
		if($user->isAllowed($_POST['token'], $_POST['userId'])){
			$token= $_POST['token'];//$request->getParameter('token');
			$unlock = $_POST['unlock']; //$request->getParameter('unlock');
			$user = new AdUser();
			$this->unlock = $user->unlock($token,$unlock);
			$log = new AdLog();
			$log->setAction('De gebruiker heeft zijn applicatie ontgrendeld.');
			$log->setAdUserId($_POST['userId']);
			$log->setDate(date('y-m-d H:m:s'));
			$log->save();
		}else{
			$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
		}
      }
    public function executeFirstLogin(sfWebRequest $request)
      {
		$user = new AdUser();
		if($user->isAllowed($_POST['token'], $_POST['userId'])){
			$uName= $_POST['uName'];// $request->getParameter('uName');
			$old = $_POST['old']; //$request->getParameter('old');
			$new= $_POST['new']; //$request->getParameter('new');
			$unlock = $_POST['unlock']; // $request->getParameter('unlock');
			$user = new AdUser();
			$this->firstLogin = $user->firstLogin($uName,$old,$new,$unlock);
			$log = new AdLog();
			$log->setAction('De gebruiker heeft zich geregistreerd.');
			$log->setAdUserId($_POST['userId']);
			$log->setDate(date('y-m-d H:m:s'));
			$log->save();
		}else{
			$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
		}
      }
}
