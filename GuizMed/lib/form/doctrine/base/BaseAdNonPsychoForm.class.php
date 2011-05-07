<?php

/**
 * AdNonPsycho form base class.
 *
 * @method AdNonPsycho getObject() Returns the current form's model object
 *
 * @package    GuizMed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdNonPsychoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ad_non_psycho_id' => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'comment'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'ad_non_psycho_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ad_non_psycho_id')), 'empty_value' => $this->getObject()->get('ad_non_psycho_id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 45)),
      'comment'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ad_non_psycho[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNonPsycho';
  }

}
