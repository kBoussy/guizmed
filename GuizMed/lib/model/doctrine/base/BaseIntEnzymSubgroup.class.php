<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('IntEnzymSubgroup', 'doctrine');

/**
 * BaseIntEnzymSubgroup
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $int_subgroup_id
 * @property string $name
 * @property Doctrine_Collection $IntDrug
 * 
 * @method integer             getIntSubgroupId()   Returns the current record's "int_subgroup_id" value
 * @method string              getName()            Returns the current record's "name" value
 * @method Doctrine_Collection getIntDrug()         Returns the current record's "IntDrug" collection
 * @method IntEnzymSubgroup    setIntSubgroupId()   Sets the current record's "int_subgroup_id" value
 * @method IntEnzymSubgroup    setName()            Sets the current record's "name" value
 * @method IntEnzymSubgroup    setIntDrug()         Sets the current record's "IntDrug" collection
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseIntEnzymSubgroup extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('int_enzym_subgroup');
        $this->hasColumn('int_subgroup_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
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
        $this->hasMany('IntDrug', array(
             'local' => 'int_subgroup_id',
             'foreign' => 'enzym_subgroup_id'));
    }
}