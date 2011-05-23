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
	$user = new AdUser();
//	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
		$this->med_forms = Doctrine_Core::getTable('medForm')
		  ->createQuery('a')
		  ->execute();
			$log = new AdLog();
			$log->setAction('De lijst met medicijnen is opgevraagd.');
			$log->setAdUserId($_POST['user_id']);
			$log->setDate(date('y-m-d H:m:s'));
			$log->save();
		$this->medicaties = Doctrine_Core::getTable('medBaseId')->createQuery('a')->orderBy('speciality')->execute();
//	}else{
//		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
//	}
  }
  public function executeIndexAdmin(sfWebRequest $request)
  {
    $this->med_forms = Doctrine_Core::getTable('medForm')
      ->createQuery('a')
      ->execute();

    $this->medicaties = Doctrine_Core::getTable('medBaseId')->createQuery('a')->orderBy('speciality')->execute();
  }
  public function executeGetmedname(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
		$this->med = Doctrine_Core::getTable('medForm')->find(array($request->getParameter('medFormId')));
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }

  public function executeShow(sfWebRequest $request)
  {
	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
		$q = Doctrine_Query::create()->from('medForm m')->where('m.med_base_id = ?', $request->getParameter('med_form_id'));
		$this->med_forms = $q->execute();
		$this->med_base_id = Doctrine_Core::getTable('medBaseId')->find(array($request->getParameter('med_form_id')));
                $this->metabolisms = array();
                $this->inhibitor = array();
                $this->inducer = array();
                foreach ($this->med_forms[0]->getAllMetabolism() as $metabolism){
                    if($metabolism->getInteractionType()=='metabolism'){
                            foreach ($metabolism->getDrugs() as $drug){
                                array_push($this->metabolisms,$drug);
                            }
                        }elseif($metabolism->getInteractionType()=='inhibitor'){
                            foreach ($metabolism->getDrugs() as $drug){
                                array_push($this->inhibitor,$drug);
                            }

                        }elseif($metabolism->getInteractionType()=='inducer'){
                            foreach ($metabolism->getDrugs() as $drug){
                                array_push($this->inducer,$drug);
                            }

                        }
                }


                $this->forward404Unless($this->med_forms);
		$log = new AdLog();
		$log->setAction('Info over volgend medicijn is opgevraagd: ' . $this->med_base_id->getSpeciality());
		$log->setAdUserId($_POST['user_id']);
		$log->setDate(date('y-m-d H:m:s'));
		$log->save();
                
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
	}
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new medFormForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
      //-------------TEST--------------
//        $_POST['med_subtype1']=1;
//        $_POST['med_subtype2']=1;
//        $_POST['mainclass']=1;
//        $_POST['gen_name']=1;
//        $_POST['speciality']=1;
//        $_POST['med_magister_form']=1;
//        $_POST['dose']=1;
//        $_POST['bioavailability']=1;
//        $_POST['proteine_binding']=1;
//        $_POST['t_max_h']=1;
//        $_POST['hlf']=1;
//        $_POST['ddd']=1;
//        $_POST['t_max_h']=1;

      //----------EIND TEST------------

	$user = new AdUser();
	if($user->isAllowed($_POST['token'], $_POST['user_id'])){
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
		  $med_form->setMedBaseId($med_base_id);
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
			  $med_form_bonding = new MedFormBonding();
			  $med_form_bonding->setMedFormId($med_form->getMedFormId());
			  $med_form_bonding->setMedChemBondingId($_POST['chem_bonding_id'][$i]);
			  $med_form_bonding->setMedKiValId($_POST['med_ki_val_id'][$i]);
                          $med_form_bonding->save();
			  $i++;
		  }
                  $i=0;
            foreach($_POST['bnf_percentage_id'] as $bnfPercentage){
               $med_bnf_medicine = new MedBnfMedicine();
               $med_bnf_medicine->setBnfPercentageId($_POST['bnf_percentage_id'][$i]);
               $med_bnf_medicine->setValue($_POST['bnf_value'][$i]);
               $med_bnf_medicine->setMedFormId($med_form->getMedFormId());
               $med_bnf_medicine->save();
               $i++;
            }
/*		  $med_bnf_medicine=new MedBnfMedicine();
		  $med_bnf_percentage = Doctrine_Query::create()->from('med_bnf_percentage mbp')->where('mbp.percentage = ?',$_POST['bnf_percentage'])->execute();
		  $med_bnf_medicine->setBnfPercentageId($med_bnf_percentage[0]->getBnfPercentageId());
		  $med_bnf_medicine->setValue($_POST['bnf_value']);
		  $med_bnf_medicine->setMedFormId($med_form->getMedFormId());
		  $med_bnf_medicine->save();
*/
$int_metabolism = new IntMetabolism();
$int_metabolism->setEnzymGroupId($_POST['metabolisatie']);
$int_metabolism->setInteractionType('metabolism');
$int_metabolism->setMedFormId($med_form->getMedFormId());
$int_metabolism->save();

$int_metabolism = new IntMetabolism();
$int_metabolism->setEnzymGroupId($_POST['activator']);
$int_metabolism->setInteractionType('activator');
$int_metabolism->setMedFormId($med_form->getMedFormId());
$int_metabolism->save();

$int_metabolism = new IntMetabolism();
$int_metabolism->setEnzymGroupId($_POST['inhibitor']);
$int_metabolism->setInteractionType('inhibitor');
$int_metabolism->setMedFormId($med_form->getMedFormId());
$int_metabolism->save();
 
		  $log = new AdLog();
		  $log->setAction('Een nieuw medicijn is toegevoegd: ' . $med_base_id->getSpeciality());
		  $log->setAdUserId($_POST['user_id']);
		  $log->setDate(date('y-m-d H:m:s'));
		  $log->save();
                
                  $this->redirect('users/error?message=medicine added!&title=success&type=message');
	  
	}else{
		$this->redirect('users/error?message=Not logged in!&title=Error&type=error');
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
        $this->redirect('users/error?message=medicine deleted!&title=success&type=message');

//    $this->redirect('medicijnbeheer/index');
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
