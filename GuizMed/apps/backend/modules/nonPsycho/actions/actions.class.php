<?php

/**
 * nonPsycho actions.
 *
 * @package    GuizMed
 * @subpackage nonPsycho
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class nonPsychoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->ad_non_psycho_pats = Doctrine_Core::getTable('adNonPsychoPat')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->ad_non_psycho_pat = Doctrine_Core::getTable('adNonPsychoPat')->find(array($request->getParameter('non_psycho_pat_id')));
    $this->forward404Unless($this->ad_non_psycho_pat);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new adNonPsychoPatForm();
  }

    public function executeStop(sfWebRequest $request)
  {
      $_POST['nonPsychoPatId'] = '7';
      $adNonPsychoPat = Doctrine_Query::create()->from('adNonPsychoPat anp')->where('anp.patient_id = ?', $_POST['nonPsychoPatId'])->execute();
      $adNonPsychoPat[0]->stop();
  }

  public function executeCreate(sfWebRequest $request)
  {


    $adNonPsychoPat = new AdNonPsychoPat();
    $adNonPsychoPat->setPatientId($_POST['patientId']);
    $adNonPsychoPat->setNonPsychoId($_POST['nonPsychoId']);
    $adNonPsychoPat->setStartDate($_POST['startDate']);
    $adNonPsychoPat->save();
  
/*    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new adNonPsychoPatForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ad_non_psycho_pat = Doctrine_Core::getTable('adNonPsychoPat')->find(array($request->getParameter('non_psycho_pat_id'))), sprintf('Object ad_non_psycho_pat does not exist (%s).', $request->getParameter('non_psycho_pat_id')));
    $this->form = new adNonPsychoPatForm($ad_non_psycho_pat);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ad_non_psycho_pat = Doctrine_Core::getTable('adNonPsychoPat')->find(array($request->getParameter('non_psycho_pat_id'))), sprintf('Object ad_non_psycho_pat does not exist (%s).', $request->getParameter('non_psycho_pat_id')));
    $this->form = new adNonPsychoPatForm($ad_non_psycho_pat);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ad_non_psycho_pat = Doctrine_Core::getTable('adNonPsychoPat')->find(array($request->getParameter('non_psycho_pat_id'))), sprintf('Object ad_non_psycho_pat does not exist (%s).', $request->getParameter('non_psycho_pat_id')));
    $ad_non_psycho_pat->delete();

    $this->redirect('nonPsycho/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ad_non_psycho_pat = $form->save();

      $this->redirect('nonPsycho/edit?non_psycho_pat_id='.$ad_non_psycho_pat->getNonPsychoPatId());
    }
  }
}
