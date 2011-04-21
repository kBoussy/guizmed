<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MedBnfPercentage', 'doctrine');

/**
 * BaseMedBnfPercentage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $med_bnf_percentage_id
 * @property string $percentage
 * @property Doctrine_Collection $MedBnfMedicine
 * 
 * @method integer             getMedBnfPercentageId()    Returns the current record's "med_bnf_percentage_id" value
 * @method string              getPercentage()            Returns the current record's "percentage" value
 * @method Doctrine_Collection getMedBnfMedicine()        Returns the current record's "MedBnfMedicine" collection
 * @method MedBnfPercentage    setMedBnfPercentageId()    Sets the current record's "med_bnf_percentage_id" value
 * @method MedBnfPercentage    setPercentage()            Sets the current record's "percentage" value
 * @method MedBnfPercentage    setMedBnfMedicine()        Sets the current record's "MedBnfMedicine" collection
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMedBnfPercentage extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('med_bnf_percentage');
        $this->hasColumn('med_bnf_percentage_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('percentage', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('MedBnfMedicine', array(
             'local' => 'med_bnf_percentage_id',
             'foreign' => 'med_bnf_percentages_id'));
    }
}