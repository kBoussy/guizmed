<?php

/**
 * MedSubtype1 form base class.
 *
 * @method MedSubtype1 getObject() Returns the current form's model object
 *
 * @package    GuizMed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMedSubtype1Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'med_subtype1_id' => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'med_subtype1_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('med_subtype1_id')), 'empty_value' => $this->getObject()->get('med_subtype1_id'), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'MedSubtype1', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('med_subtype1[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MedSubtype1';
  }

}
