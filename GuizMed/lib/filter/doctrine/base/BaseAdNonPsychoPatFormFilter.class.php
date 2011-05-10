<?php

/**
 * AdNonPsychoPat filter form base class.
 *
 * @package    GuizMed
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdNonPsychoPatFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'ad_patient_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdPatient'), 'add_empty' => true)),
      'non_psycho_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdNonPsycho'), 'add_empty' => true)),
      'start_date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'stop_date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'ad_patient_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdPatient'), 'column' => 'patient_id')),
      'non_psycho_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdNonPsycho'), 'column' => 'ad_non_psycho_id')),
      'start_date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'stop_date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ad_non_psycho_pat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdNonPsychoPat';
  }

  public function getFields()
  {
    return array(
      'non_psycho_pat_id' => 'Number',
      'ad_patient_id'     => 'ForeignKey',
      'non_psycho_id'     => 'ForeignKey',
      'start_date'        => 'Date',
      'stop_date'         => 'Date',
    );
  }
}
