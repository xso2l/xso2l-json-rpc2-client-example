<?php

namespace App\Services;

use App\Repositories\VisitsRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VisitsService
{
    protected $visitsRepository;

    public function __construct(VisitsRepository $visitsRepository)
    {
        $this->visitsRepository = $visitsRepository;
    }

    public function get($data)
    {
        $validator = Validator::make($data, [
            'page' => 'required|numeric',
            'page_size' => 'required|numeric'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        try {
            return $this->visitsRepository->get($data);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to get visits');
        }
    }


    public function add($data)
    {
        $validator = Validator::make($data, [
            'url' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }
        try {
            return $this->visitsRepository->add($data);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to add visit');
        }
    }

}
