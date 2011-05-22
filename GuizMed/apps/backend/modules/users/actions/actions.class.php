<?php

/**
 * users actions.
 *
 * @package    GuizMed
 * @subpackage users
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class usersActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$user = new AdUser();
        $this->postUser = $_POST['user_id'];
	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
		$this->ad_users = Doctrine_Core::getTable('adUser')
		  ->createQuery('a')
		  ->execute();
		$log = new AdLog();
		$log->setAction('De gebruiker heeft de lijst met gebruikers opgevraagd.');
		$log->setAdUserId($_POST['user_id']);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }
/*  public function executeIndex(sfWebRequest $request)
  {
      $message = $_POST['message'];
      $title = $_POST['title'];
      $type = $_POST['type'];
  }*/
  public function executeError(sfWebRequest $request){
      $this->message =$request->getParameter('message');
      $this->title =$request->getParameter('title');
      $this->type =$request->getParameter('type');
  }
  public function executeShow(sfWebRequest $request)
  {
//      $headers = "From: ".'Kim Boussy'."<the_chosen_dragon@hotmail.com>\r\n";
//      mail('kim.boussy@howest.be','hallo','yu',$headers);
    // send an email to the affiliate
/*    $message = $this->getMailer()->compose(
      array('henry@zaagt.turk' => 'Info'),
      'kim.boussy@howest.be',
      'Belangrijke info',
      "<<<EOF
OLE OLE!

Ge word gestalkt jong

greetings. Kim's evil backend.
EOF"
    );
    $this->getMailer()->send($message);*/
//    $this->redirect('jobeet_affiliate');
    $this->ad_user = Doctrine_Core::getTable('adUser')->find(array($request->getParameter('user_id')));
    $this->forward404Unless($this->ad_user);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new adUserForm();
  }
  public function executeListActivate()
  {
  }

  public function executeCheck(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()->from('AdUserPatient aup')->where('aup.patient_id=?',$_POST['patient_id'])->andWhere('aup.user_id = ?', $_POST['user_id'])->execute();
    if($q->count()==0){
        $this->allowed = false;
    }else{
        $this->allowed = true;
    }
  }
  public function executeCreate(sfWebRequest $request)
  {
      //--------------------TEST------------------
//        $_POST['fName']='HEHE2222';
  //      $_POST['lName']='HOHO';
    //    $_POST['eMail']='the_chosen_dragon@hotmail.com';
     //  $_POST['phone']='105512';

        //-------------------einde test---------------

        $user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
        $user = new AdUser();
  

        $user->setFname($_POST['fName']);
        $user->setLname($_POST['lName']);
        $user->setEmail($_POST['eMail']);
        $user->setAdRoleId('2');
        $user->setAdFunctionId('2');
        $user->setUname(strtolower($user->getFname().'.'.$user->getLname()));
        $user->setPassw($this->generatePassword());
        $user->setPhone($_POST['phone']);
        $user->save();


$to = $user->getEmail();
$subject = "Account created";
$message = <<<EOF
Hello,

Your account has been created.
Username: {$user->getUname()}
Password: {$user->getPassw()}

hope to see you soon doctor.

Greetings the guizmedbot.

EOF;
$from = "bot@guizmed.be";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
//        $this->redirect('show_user',array('user_id'=>$user->getUserId()));
//    $this->forward404Unless($request->isMethod(sfRequest::POST));
//    $this->form = new adUserForm();
//    $this->processForm($request, $this->form);
//    $this->setTemplate('new');
		$log = new AdLog();
		$log->setAction('De gebruiker heeft een nieuwe gebruiker toegevoegd: ' . $user->getFname() . ' ' . $user->getLname());
		$log->setAdUserId(/*$_POST['user_id']*/1);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
        $this->redirect('users/error?message=user created!&title=success&type=message');
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
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
//    $request->checkCSRFProtection();
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
    $this->forward404Unless($ad_user = Doctrine_Core::getTable('adUser')->find(array($request->getParameter('user_id'))), sprintf('Object ad_user does not exist (%s).', $request->getParameter('user_id')));
                $log = new AdLog();
		$log->setAction('De gebruiker heeft een andere gebruiker verwijderd: ' . $ad_user->getFname() . $ad_user->getLname());
		$log->setAdUserId($_POST['user_id']);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
        
        	$ad_user->delete();
                $this->redirect('users/error?message=user deleted!&title=success&type=message');
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ad_user = $form->save();

      $this->redirect('users/edit?user_id='.$ad_user->getUserId());
    }
  }
  function generatePassword ($length = 8)
  {

    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
      $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);

      // have we already used this character in $password?
      if (!strstr($password, $char)) {
        // no, so it's OK to add it onto the end of whatever we've already got...
        $password .= $char;
        // ... and increase the counter by one
        $i++;
      }

    }

    // done!
    return $password;

  }










}
