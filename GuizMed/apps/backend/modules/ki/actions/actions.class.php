<?php

/**
 * ki actions.
 *
 * @package    GuizMed
 * @subpackage ki
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class kiActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->med_ki_vals = Doctrine_Core::getTable('medKiVal')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->med_ki_val = Doctrine_Core::getTable('medKiVal')->find(array($request->getParameter('med_ki_val_id')));
    $this->forward404Unless($this->med_ki_val);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medKiValForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
  
      $med_ki_val = new MedKiVal();
      $med_ki_val->setValue($_POST['value']);
      $med_ki_val->setInfluence($_POST['influence']);
      $med_ki_val->setTagval($_POST['tagval']);
      $med_ki_val->save();


/*    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new medKiValForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($med_ki_val = Doctrine_Core::getTable('medKiVal')->find(array($request->getParameter('med_ki_val_id'))), sprintf('Object med_ki_val does not exist (%s).', $request->getParameter('med_ki_val_id')));
    $this->form = new medKiValForm($med_ki_val);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($med_ki_val = Doctrine_Core::getTable('medKiVal')->find(array($request->getParameter('med_ki_val_id'))), sprintf('Object med_ki_val does not exist (%s).', $request->getParameter('med_ki_val_id')));
    $this->form = new medKiValForm($med_ki_val);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($med_ki_val = Doctrine_Core::getTable('medKiVal')->find(array($request->getParameter('med_ki_val_id'))), sprintf('Object med_ki_val does not exist (%s).', $request->getParameter('med_ki_val_id')));
    $med_ki_val->delete();

    $this->redirect('ki/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $med_ki_val = $form->save();

      $this->redirect('ki/edit?med_ki_val_id='.$med_ki_val->getMedKiValId());
    }
  }
}
