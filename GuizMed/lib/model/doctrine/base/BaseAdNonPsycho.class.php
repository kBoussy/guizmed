<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('AdNonPsycho', 'doctrine');

/**
 * BaseAdNonPsycho
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ad_non_psycho_id
 * @property string $name
 * @property blob $comment
 * @property Doctrine_Collection $AdNonPsychoPat
 * 
 * @method integer             getAdNonPsychoId()    Returns the current record's "ad_non_psycho_id" value
 * @method string              getName()             Returns the current record's "name" value
 * @method blob                getComment()          Returns the current record's "comment" value
 * @method Doctrine_Collection getAdNonPsychoPat()   Returns the current record's "AdNonPsychoPat" collection
 * @method AdNonPsycho         setAdNonPsychoId()    Sets the current record's "ad_non_psycho_id" value
 * @method AdNonPsycho         setName()             Sets the current record's "name" value
 * @method AdNonPsycho         setComment()          Sets the current record's "comment" value
 * @method AdNonPsycho         setAdNonPsychoPat()   Sets the current record's "AdNonPsychoPat" collection
 * 
 * @package    GuizMed
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAdNonPsycho extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ad_non_psycho');
        $this->hasColumn('ad_non_psycho_id', 'integer', 4, array(
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
             'notnull' => true,
             'autoincrement' => false,
             'length' => 45,
             ));
        $this->hasColumn('comment', 'blob', null, array(
             'type' => 'blob',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('AdNonPsychoPat', array(
             'local' => 'ad_non_psycho_id',
             'foreign' => 'non_psycho_id'));
    }
}