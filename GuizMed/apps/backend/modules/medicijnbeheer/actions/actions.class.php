<?php

/**
 * medicijnbeheer actions.
 *
 * @package    GuizMed
 * @subpackage medicijnbeheer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class medicijnbeheerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->med_forms = Doctrine_Core::getTable('medForm')
      ->createQuery('a')
      ->execute();

    $this->medicaties = Doctrine_Core::getTable('medBaseId')->createQuery('a')->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()->from('medForm m')->where('m.med_base_id = ?', $request->getParameter('med_form_id'));
    $this->med_forms = $q->execute();
    $this->med_base_id = Doctrine_Core::getTable('medBaseId')->find(array($request->getParameter('med_form_id')));
    $this->forward404Unless($this->med_forms);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medFormForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
  if(isset($_POST['fName'])){
      $med_type = new MedType();
      $med_type->setMedSubtype1Id($_POST['med_subtype1']);
      $med_type->setMedSubtype2Id($_POST['med_subtype2']);
      $med_type->save();

      $med_base_id = new MedBaseId();
      $med_base_id->setMainclass($_POST['mainclass']);
      $med_base_id->setGenName($_POST['gen_name']);
      $med_base_id->setSpeciality($_POST['speciality']);
      $med_base_id->setMedTypeId($med_type->getMedTypeId());
      $med_base_id->save();

      $med_form = new MedForm();
      $med_form->setMedBaseId($med_base_id->getMedBaseId());
      $med_form->setMedMagisterFormId($_POST['med_magister_form']);
      $med_form->setDose($_POST['dose']);
      $med_form->setBioavailability($_POST['bioavailability']);
      $med_form->setProteineBinding($_POST['proteine_binding']);
      $med_form->setTMaxH($_POST['t_max_h']);
      $med_form->setHlf($_POST['hlf']);
      $med_form->setDdd($_POST['ddd']);
      $med_form->save();
      $i = 0;
      foreach($_POST['chem_bonding_id'] as $chemBonding){
          $med_form_bonding = new medFormBonding();
          $med_form_bonding->setMedFormBondingId($med_form->getMedFormId());
          $med_form_bonding->setMedChemBondingId($_POST['chem_bonding_id'][$i]);
          $med_form_bonding->setMedKiValId($_POST['med_ki_val_id'][$i]);
          $i++;
      }

      $med_bnf_medicine=new MedBnfMedicine();
      $med_bnf_percentage = Doctrine_Query::create()->from('med_bnf_percentage mbp')->where('mbp.percentage = ?',$_POST['bnf_percentage'])->execute();
      $med_bnf_medicine->setBnfPercentageId($med_bnf_percentage[0]->getBnfPercentageId());
      $med_bnf_medicine->setValue($_POST['bnf_value']);
      $med_bnf_medicine->setMedFormId($med_form->getMedFormId());
      $med_bnf_medicine->save();

      $int_metabolism = new IntMetabolism();
      $int_metabolism->setEnzymGroupId($_POST['enzym_name']);
      $int_metabolism->setMedFormId($med_form->getMedFormId());
      $int_metabolism->save();
      }
/*    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new medFormForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');*/
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($med_form = Doctrine_Core::getTable('medForm')->find(array($request->getParameter('med_form_id'))), sprintf('Object med_form does not exist (%s).', $request->getParameter('med_form_id')));
    $this->form = new medFormForm($med_form);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($med_form = Doctrine_Core::getTable('medForm')->find(array($request->getParameter('med_form_id'))), sprintf('Object med_form does not exist (%s).', $request->getParameter('med_form_id')));
    $this->form = new medFormForm($med_form);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($med_form = Doctrine_Core::getTable('medForm')->find(array($request->getParameter('med_form_id'))), sprintf('Object med_form does not exist (%s).', $request->getParameter('med_form_id')));
    $med_form->delete();

    $this->redirect('medicijnbeheer/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $med_form = $form->save();

      $this->redirect('medicijnbeheer/edit?med_form_id='.$med_form->getMedFormId());
    }
  }
}
