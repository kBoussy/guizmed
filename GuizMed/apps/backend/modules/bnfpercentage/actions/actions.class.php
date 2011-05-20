<?php

/**
 * bnfpercentage actions.
 *
 * @package    GuizMed
 * @subpackage bnfpercentage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bnfpercentageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->med_bnf_percentages = Doctrine_Core::getTable('medBnfPercentage')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->med_bnf_percentage = Doctrine_Core::getTable('medBnfPercentage')->find(array($request->getParameter('bnf_percentage_id')));
    $this->forward404Unless($this->med_bnf_percentage);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medBnfPercentageForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new medBnfPercentageForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($med_bnf_percentage = Doctrine_Core::getTable('medBnfPercentage')->find(array($request->getParameter('bnf_percentage_id'))), sprintf('Object med_bnf_percentage does not exist (%s).', $request->getParameter('bnf_percentage_id')));
    $this->form = new medBnfPercentageForm($med_bnf_percentage);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($med_bnf_percentage = Doctrine_Core::getTable('medBnfPercentage')->find(array($request->getParameter('bnf_percentage_id'))), sprintf('Object med_bnf_percentage does not exist (%s).', $request->getParameter('bnf_percentage_id')));
    $this->form = new medBnfPercentageForm($med_bnf_percentage);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($med_bnf_percentage = Doctrine_Core::getTable('medBnfPercentage')->find(array($request->getParameter('bnf_percentage_id'))), sprintf('Object med_bnf_percentage does not exist (%s).', $request->getParameter('bnf_percentage_id')));
    $med_bnf_percentage->delete();

    $this->redirect('bnfpercentage/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $med_bnf_percentage = $form->save();

      $this->redirect('bnfpercentage/edit?bnf_percentage_id='.$med_bnf_percentage->getBnfPercentageId());
    }
  }
}
