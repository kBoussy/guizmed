<?php

/**
 * enzym actions.
 *
 * @package    GuizMed
 * @subpackage enzym
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class enzymActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->int_enzyms = Doctrine_Core::getTable('intEnzym')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->int_enzym = Doctrine_Core::getTable('intEnzym')->find(array($request->getParameter('int_enzym_id')));
    $this->forward404Unless($this->int_enzym);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new intEnzymForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new intEnzymForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($int_enzym = Doctrine_Core::getTable('intEnzym')->find(array($request->getParameter('int_enzym_id'))), sprintf('Object int_enzym does not exist (%s).', $request->getParameter('int_enzym_id')));
    $this->form = new intEnzymForm($int_enzym);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($int_enzym = Doctrine_Core::getTable('intEnzym')->find(array($request->getParameter('int_enzym_id'))), sprintf('Object int_enzym does not exist (%s).', $request->getParameter('int_enzym_id')));
    $this->form = new intEnzymForm($int_enzym);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($int_enzym = Doctrine_Core::getTable('intEnzym')->find(array($request->getParameter('int_enzym_id'))), sprintf('Object int_enzym does not exist (%s).', $request->getParameter('int_enzym_id')));
    $int_enzym->delete();

    $this->redirect('enzym/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $int_enzym = $form->save();

      $this->redirect('enzym/edit?int_enzym_id='.$int_enzym->getIntEnzymId());
    }
  }
}
