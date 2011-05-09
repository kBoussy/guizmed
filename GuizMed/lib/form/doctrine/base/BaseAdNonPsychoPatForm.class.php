<?php

/**
 * AdNonPsychoPat form base class.
 *
 * @method AdNonPsychoPat getObject() Returns the current form's model object
 *
 * @package    GuizMed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdNonPsychoPatForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'non_psycho_pat_id' => new sfWidgetFormInputHidden(),
      'patient_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUserPatient'), 'add_empty' => false)),
      'non_psycho_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdNonPsycho'), 'add_empty' => false)),
      'start_date'        => new sfWidgetFormDateTime(),
      'stop_date'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'non_psycho_pat_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('non_psycho_pat_id')), 'empty_value' => $this->getObject()->get('non_psycho_pat_id'), 'required' => false)),
      'patient_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdUserPatient'))),
      'non_psycho_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdNonPsycho'))),
      'start_date'        => new sfValidatorDateTime(),
      'stop_date'         => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ad_non_psycho_pat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNonPsychoPat';
  }

}
