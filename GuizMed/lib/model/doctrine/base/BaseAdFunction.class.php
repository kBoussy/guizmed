<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AdFunction', 'doctrine');

/**
 * BaseAdFunction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $function_id
 * @property string $name
 * @property Doctrine_Collection $AdUser
 * 
 * @method integer             getFunctionId()  Returns the current record's "function_id" value
 * @method string              getName()        Returns the current record's "name" value
 * @method Doctrine_Collection getAdUser()      Returns the current record's "AdUser" collection
 * @method AdFunction          setFunctionId()  Sets the current record's "function_id" value
 * @method AdFunction          setName()        Sets the current record's "name" value
 * @method AdFunction          setAdUser()      Sets the current record's "AdUser" collection
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAdFunction extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ad_function');
        $this->hasColumn('function_id', 'integer', 4, array(
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
        $this->hasMany('AdUser', array(
             'local' => 'function_id',
             'foreign' => 'ad_function_id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}