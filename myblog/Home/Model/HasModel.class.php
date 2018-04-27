<?php 
namespace Home\Model;

use Think\Model\RelationModel;

class HasModel extends RelationModel
{
        protected $_link = array(
        "Article" => array(
            "mapping_type" => self::HAS_MANY,
            'class_name'    => 'Article',
            'foreign_key'   => 'article_id',
            'mapping_name'  => 'articles',
            'mapping_order' => 'create_time desc',

             ),
       );
}