<?php
declare(strict_types=1);

namespace app\dto;

/**
 * Description of Explain
 *
 * @author oleg
 */
class ExplainDTO
{
    public int $id;
    public string $select_type;
    public string $table;
    public ?string $partitions;
    public string $type;
    public ?string $possible_keys;
    public ?string $key;
    public ?string $key_len;
    public ?string $ref;
    public int $rows;
    public float $filtered;
    public ?string $Extra;
    
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->select_type = $data['select_type'];
        $this->table = $data['table'];
        $this->partitions = $data['partitions'];
        $this->type = $data['type'];
        $this->possible_keys = $data['possible_keys'];
        $this->key = $data['key'];
        $this->key_len = $data['key_len'];
        $this->ref = $data['ref'];
        $this->rows = $data['rows'];
        $this->filtered = $data['filtered'];
        $this->Extra = $data['Extra'];
    }
}
