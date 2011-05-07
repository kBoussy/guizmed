<?php

/**
 * AdNotification filter form base class.
 *
 * @package    GuizMed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdNotificationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'prev_user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser'), 'add_empty' => true)),
      'new_user_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdUser_3'), 'add_empty' => true)),
      'patient_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdPatient'), 'add_empty' => true)),
      'reason'          => new sfWidgetFormFilterInput(),
      'accepted'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'checked'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'prev_user_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdUser'), 'column' => 'user_id')),
      'new_user_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdUser_3'), 'column' => 'user_id')),
      'patient_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdPatient'), 'column' => 'patient_id')),
      'reason'          => new sfValidatorPass(array('required' => false)),
      'accepted'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'checked'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_notification_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNotification';
  }

  public function getFields()
  {
    return array(
      'notification_id' => 'Number',
      'prev_user_id'    => 'ForeignKey',
      'new_user_id'     => 'ForeignKey',
      'patient_id'      => 'ForeignKey',
      'reason'          => 'Text',
      'accepted'        => 'Number',
      'checked'         => 'Number',
      'date'            => 'Date',
    );
  }
}
