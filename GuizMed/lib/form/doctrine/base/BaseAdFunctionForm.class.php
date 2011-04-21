<?php

/**
 * AdFunction form base class.
 *
 * @method AdFunction getObject() Returns the current form's model object
 *
 * @package    GuizMed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdFunctionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'function_id' => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'function_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('function_id')), 'empty_value' => $this->getObject()->get('function_id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ad_function[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdFunction';
  }

}
