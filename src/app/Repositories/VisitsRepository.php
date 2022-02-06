<?php

namespace App\Repositories;

use App\Models\Visit;

class VisitsRepository extends RPCRepository
{
    protected $visit;

    public function __construct(Visit $visit)
    {
        parent::__construct();
        $this->visit = $visit;
    }

    public function get($data)
    {
        $response = $this->getRPCClient()->execute('visits@get', $data);
        return $response->result();
    }

    public function add($data)
    {
        $response = $this->getRPCClient()->execute('visits@hit', $data);
        return $response->result();
    }


}
