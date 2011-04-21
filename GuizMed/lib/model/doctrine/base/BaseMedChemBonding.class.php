<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('MedChemBonding', 'doctrine');

/**
 * BaseMedChemBonding
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $med_chem_bonding_id
 * @property string $name
 * @property Doctrine_Collection $MedFormBonding
 * 
 * @method integer             getMedChemBondingId()    Returns the current record's "med_chem_bonding_id" value
 * @method string              getName()                Returns the current record's "name" value
 * @method Doctrine_Collection getMedFormBonding()      Returns the current record's "MedFormBonding" collection
 * @method MedChemBonding      setMedChemBondingId()    Sets the current record's "med_chem_bonding_id" value
 * @method MedChemBonding      setName()                Sets the current record's "name" value
 * @method MedChemBonding      setMedFormBonding()      Sets the current record's "MedFormBonding" collection
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMedChemBonding extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('med_chem_bonding');
        $this->hasColumn('med_chem_bonding_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 45, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 45,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('MedFormBonding', array(
             'local' => 'med_chem_bonding_id',
             'foreign' => 'med_chem_bonding_id'));
    }
}