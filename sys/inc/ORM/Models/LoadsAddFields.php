<?php
/*---------------------------------------------\
|											   |
| @Author:       Andrey Brykin (Drunya)        |
| @Version:      1.0                           |
| @Project:      CMS                           |
| @Package       AtomX CMS                     |
| @subpackege    NewsAddFields Model           |
| @copyright     ©Andrey Brykin 2010-2012      |
| @last mod      2012/04/29                    |
|----------------------------------------------|
|											   |
| any partial or not partial extension         |
| CMS AtomX,without the consent of the         |
| author, is illegal                           |
|----------------------------------------------|
| Любое распространение                        |
| CMS AtomX или ее частей,                     |
| без согласия автора, является не законным    |
\---------------------------------------------*/



/**
 *
 */
class LoadsAddFieldsModel extends FpsModel
{
	
    public $Table = 'loads_add_fields';

	
    protected $RelatedEntities = array(
        'content' => array(
            'model' => 'LoadsAddContent',
            'type' => 'has_many',
            'foreignKey' => 'field_id',
      	),
    );
}