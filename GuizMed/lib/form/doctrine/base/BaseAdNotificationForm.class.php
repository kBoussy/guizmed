<?php

/**
 * AdNotification form base class.
 *
 * @method AdNotification getObject() Returns the current form's model object
 *
 * @package    GuizMed
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdNotificationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'notification_id' => new sfWidgetFormInputHidden(),
<<<<<<< HEAD
      'prev_user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser'), 'add_empty' => false)),
      'new_user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser_3'), 'add_empty' => false)),
=======
      'prev_user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser_3'), 'add_empty' => false)),
      'new_user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser'), 'add_empty' => false)),
>>>>>>> oj/master
      'patient_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdPatient'), 'add_empty' => false)),
      'reason'          => new sfWidgetFormTextarea(),
      'accepted'        => new sfWidgetFormInputText(),
      'checked'         => new sfWidgetFormInputText(),
      'date'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'notification_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('notification_id')), 'empty_value' => $this->getObject()->get('notification_id'), 'required' => false)),
<<<<<<< HEAD
      'prev_user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser'))),
      'new_user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser_3'))),
=======
      'prev_user_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser_3'))),
      'new_user_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser'))),
>>>>>>> oj/master
      'patient_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdPatient'))),
      'reason'          => new sfValidatorString(array('required' => false)),
      'accepted'        => new sfValidatorInteger(array('required' => false)),
      'checked'         => new sfValidatorInteger(array('required' => false)),
      'date'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ad_notification[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNotification';
  }

}
