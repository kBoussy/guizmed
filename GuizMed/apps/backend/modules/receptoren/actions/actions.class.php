<?php

/**
 * receptoren actions.
 *
 * @package    GuizMed
 * @subpackage receptoren
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class receptorenActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->med_chem_bondings = Doctrine_Core::getTable('medChemBonding')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->id = $request->getParameter('med_chem_bonding_id');
    $this->med_form_bondings = Doctrine_Query::create()->from('medFormBonding mfb')->where('mfb.med_chem_bonding_id = ?',$request->getParameter('med_chem_bonding_id'))->execute();
    $this->forward404Unless($this->med_form_bondings);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medChemBondingForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new medChemBondingForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($med_chem_bonding = Doctrine_Core::getTable('medChemBonding')->find(array($request->getParameter('chem_bonding_id'))), sprintf('Object med_chem_bonding does not exist (%s).', $request->getParameter('chem_bonding_id')));
    $this->form = new medChemBondingForm($med_chem_bonding);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($med_chem_bonding = Doctrine_Core::getTable('medChemBonding')->find(array($request->getParameter('chem_bonding_id'))), sprintf('Object med_chem_bonding does not exist (%s).', $request->getParameter('chem_bonding_id')));
    $this->form = new medChemBondingForm($med_chem_bonding);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($med_chem_bonding = Doctrine_Core::getTable('medChemBonding')->find(array($request->getParameter('chem_bonding_id'))), sprintf('Object med_chem_bonding does not exist (%s).', $request->getParameter('chem_bonding_id')));
    $med_chem_bonding->delete();

    $this->redirect('receptoren/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $med_chem_bonding = $form->save();

      $this->redirect('receptoren/edit?chem_bonding_id='.$med_chem_bonding->getChemBondingId());
    }
  }
}
