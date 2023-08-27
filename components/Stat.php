<?php
namespace app\components;

use Yii;
use app\dto\ExplainDTO;
use app\dto\ProfileDTO;

class Stat 
{
    public function explain(string $query): ProfileDTO
    {
        $explainData = [];
        
        Yii::$app->db->createCommand('set profiling = 1')->execute();
        $preparedQuery = $this->prepareQuery($query);
        
        $rawData = Yii::$app->db
            ->createCommand($preparedQuery)
            ->queryAll();
        
        $statData = Yii::$app->db->createCommand('show profiles')->queryOne();
        $duration = $statData['Duration'];
        
        Yii::$app->db->createCommand('set profiling = 0')->execute();
        
        foreach ($rawData as $row) {
            $explainData[] = new ExplainDTO($row);
        }
        
        $dto = new ProfileDTO();
        $dto->explainData = $explainData;
        $dto->duration = $duration;
        
        return $dto;
    }
    
    private function prepareQuery(string $query): string
    {        
        return implode(' ', ['explain', $query]);
    }    
}
