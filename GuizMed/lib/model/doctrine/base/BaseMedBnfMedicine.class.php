<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MedBnfMedicine', 'doctrine');

/**
 * BaseMedBnfMedicine
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $med_bnf_medicine_id
 * @property integer $med_bnf_percentages_id
 * @property integer $med_form_id
 * @property float $value
 * @property MedBnfPercentage $MedBnfPercentage
 * @property MedForm $MedForm
 * 
 * @method integer          getMedBnfMedicineId()       Returns the current record's "med_bnf_medicine_id" value
 * @method integer          getMedBnfPercentagesId()    Returns the current record's "med_bnf_percentages_id" value
 * @method integer          getMedFormId()              Returns the current record's "med_form_id" value
 * @method float            getValue()                  Returns the current record's "value" value
 * @method MedBnfPercentage getMedBnfPercentage()       Returns the current record's "MedBnfPercentage" value
 * @method MedForm          getMedForm()                Returns the current record's "MedForm" value
 * @method MedBnfMedicine   setMedBnfMedicineId()       Sets the current record's "med_bnf_medicine_id" value
 * @method MedBnfMedicine   setMedBnfPercentagesId()    Sets the current record's "med_bnf_percentages_id" value
 * @method MedBnfMedicine   setMedFormId()              Sets the current record's "med_form_id" value
 * @method MedBnfMedicine   setValue()                  Sets the current record's "value" value
 * @method MedBnfMedicine   setMedBnfPercentage()       Sets the current record's "MedBnfPercentage" value
 * @method MedBnfMedicine   setMedForm()                Sets the current record's "MedForm" value
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMedBnfMedicine extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('med_bnf_medicine');
        $this->hasColumn('med_bnf_medicine_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('med_bnf_percentages_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('med_form_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('value', 'float', null, array(
             'type' => 'float',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('MedBnfPercentage', array(
             'local' => 'med_bnf_percentages_id',
             'foreign' => 'med_bnf_percentage_id'));

        $this->hasOne('MedForm', array(
             'local' => 'med_form_id',
             'foreign' => 'med_form_id'));
    }
}