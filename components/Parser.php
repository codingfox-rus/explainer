<?php
namespace app\components;

//use Yii;
use yii\base\BaseObject;
use app\dto\ExpressionDTO;

class Parser extends BaseObject
{
    public function __construct($config = []) 
    {
        parent::__construct($config);
    }    
    
    public function compute(string $query): string
    {
        $parts = explode('WHERE', $query);
        $where = $parts[1];
        $whereParts = array_map('trim', explode('=', $where));
        
        $expressionDTO = new ExpressionDTO();
        $expressionDTO->field = $whereParts[0];
        $expressionDTO->operator = '=';
        $expressionDTO->value = $whereParts[1];
        
        return '';
    }    
}
