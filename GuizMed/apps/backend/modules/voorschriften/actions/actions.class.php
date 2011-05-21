<?php

/**
 * voorschriften actions.
 *
 * @package    GuizMed
 * @subpackage voorschriften
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class voorschriftenActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['userId'])){
		$this->ad_prescriptions = Doctrine_Core::getTable('adPrescription')
		  ->createQuery('a')
		  ->execute();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }
  public function executeStop(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['userId'])){
      if(isset($_POST['reason'])){
		$ad_prescription = Doctrine_Core::getTable('adPrescription')->find(array($request->getParameter('ad_presc_id')));
		$ad_prescription->stop($_POST['reason']);
      }else{
		$ad_prescription = Doctrine_Core::getTable('adPrescription')->find(array($request->getParameter('ad_presc_id')));
		$ad_prescription->stop("No reason was given.");
      }
	  $ad_user_patient = Doctrine_Core::getTable('adUserPatient')->find(array($ad_prescription->getUserPatientId()));
	  $ad_patient = Doctrine_Core::getTable('adPatient')->find(array($ad_user_patient->getPatientId()))
		$log = new AdLog();
		$log->setAction('De gebruiker heeft een voorschrift stopgezet voor patient' . $ad_patient->getFname() . ' ' . $ad_patient->getLname());
		$log->setAdUserId($_POST['userId']);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }
  public function executeShow(sfWebRequest $request)
  {
    $this->ad_prescription = Doctrine_Core::getTable('adPrescription')->find(array($request->getParameter('ad_presc_id')));
    $this->forward404Unless($this->ad_prescription);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new adPrescriptionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['userId'])){
      if(isset($_POST['startDate'])){
        $prescription = new AdPrescription();
        $prescription->setStartDate($_POST['startDate']);
        $prescription->setPrescDate(date('y-m-d H:m:s'));
        $prescription->setDose($_POST['dose']);
        $prescription->setFrequency($_POST['frequency']);
        $prescription->setMedFormId($_POST['medFormId']);
        $userPatients= Doctrine_Query::create()->from('AdUserPatient aup')->where('aup.patient_id = ?',$_POST['patientId'])->execute();
        $prescription->setUserPatientId($userPatients[0]->getUserPatientId());
        $prescription->setComment($_POST['comment']);
        $prescription->save();
        $this->redirect('show_prescription',array('ad_presc_id'=>$prescription->getAdPrescId()));
      }else{
         $this->forward404('ge moet startDate invullen dumbo');
      }
		$ad_patient = Doctrine_Core::getTable('adPatient')->find(array($_POST['patientId']));

		$log = new AdLog();
		$log->setAction('De gebruiker heeft een voorschrift toegevoegd voor patient' . $ad_patient->getFname() . ' ' . $ad_patient->getLname());
		$log->setAdUserId($_POST['userId']);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
      
/*    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new adPrescriptionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ad_prescription = Doctrine_Core::getTable('adPrescription')->find(array($request->getParameter('ad_presc_id'))), sprintf('Object ad_prescription does not exist (%s).', $request->getParameter('ad_presc_id')));
    $this->form = new adPrescriptionForm($ad_prescription);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ad_prescription = Doctrine_Core::getTable('adPrescription')->find(array($request->getParameter('ad_presc_id'))), sprintf('Object ad_prescription does not exist (%s).', $request->getParameter('ad_presc_id')));
    $this->form = new adPrescriptionForm($ad_prescription);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ad_prescription = Doctrine_Core::getTable('adPrescription')->find(array($request->getParameter('ad_presc_id'))), sprintf('Object ad_prescription does not exist (%s).', $request->getParameter('ad_presc_id')));
    $ad_prescription->delete();

    $this->redirect('voorschriften/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ad_prescription = $form->save();

      $this->redirect('voorschriften/edit?ad_presc_id='.$ad_prescription->getAdPrescId());
    }
  }
}
