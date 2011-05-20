<?php

/**
 * medmagister actions.
 *
 * @package    GuizMed
 * @subpackage medmagister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class medmagisterActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->med_magister_forms = Doctrine_Core::getTable('medMagisterForm')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->med_magister_form = Doctrine_Core::getTable('medMagisterForm')->find(array($request->getParameter('med_magister_form_id')));
    $this->forward404Unless($this->med_magister_form);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medMagisterFormForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new medMagisterFormForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($med_magister_form = Doctrine_Core::getTable('medMagisterForm')->find(array($request->getParameter('med_magister_form_id'))), sprintf('Object med_magister_form does not exist (%s).', $request->getParameter('med_magister_form_id')));
    $this->form = new medMagisterFormForm($med_magister_form);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($med_magister_form = Doctrine_Core::getTable('medMagisterForm')->find(array($request->getParameter('med_magister_form_id'))), sprintf('Object med_magister_form does not exist (%s).', $request->getParameter('med_magister_form_id')));
    $this->form = new medMagisterFormForm($med_magister_form);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($med_magister_form = Doctrine_Core::getTable('medMagisterForm')->find(array($request->getParameter('med_magister_form_id'))), sprintf('Object med_magister_form does not exist (%s).', $request->getParameter('med_magister_form_id')));
    $med_magister_form->delete();

    $this->redirect('medmagister/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $med_magister_form = $form->save();

      $this->redirect('medmagister/edit?med_magister_form_id='.$med_magister_form->getMedMagisterFormId());
    }
  }
}
