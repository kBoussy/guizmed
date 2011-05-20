<?php

/**
 * medtypes actions.
 *
 * @package    GuizMed
 * @subpackage medtypes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class medtypesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->med_types = Doctrine_Core::getTable('medType')
      ->createQuery('a')
      ->execute();

    $this->med_types1 = Doctrine_Core::getTable('medSubtype1')
      ->createQuery('a')
      ->execute();
    $this->med_types2 = Doctrine_Core::getTable('medSubtype2')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->med_type = Doctrine_Core::getTable('medType')->find(array($request->getParameter('med_type_id')));
    $this->forward404Unless($this->med_type);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medTypeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new medTypeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($med_type = Doctrine_Core::getTable('medType')->find(array($request->getParameter('med_type_id'))), sprintf('Object med_type does not exist (%s).', $request->getParameter('med_type_id')));
    $this->form = new medTypeForm($med_type);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($med_type = Doctrine_Core::getTable('medType')->find(array($request->getParameter('med_type_id'))), sprintf('Object med_type does not exist (%s).', $request->getParameter('med_type_id')));
    $this->form = new medTypeForm($med_type);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($med_type = Doctrine_Core::getTable('medType')->find(array($request->getParameter('med_type_id'))), sprintf('Object med_type does not exist (%s).', $request->getParameter('med_type_id')));
    $med_type->delete();

    $this->redirect('medtypes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $med_type = $form->save();

      $this->redirect('medtypes/edit?med_type_id='.$med_type->getMedTypeId());
    }
  }
}
