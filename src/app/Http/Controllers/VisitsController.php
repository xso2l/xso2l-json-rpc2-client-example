<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisitsService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class VisitsController extends Controller
{
    protected $visitsService;

    public function __construct(VisitsService $visitsService)
    {
        $this->visitsService = $visitsService;
    }

    public function index(Request $request)
    {
        $params = $this->getWithDefaults($request->only(['page', 'page_size']),
                                                        ['page' => 1, 'page_size' => 5]);
        $visitsCollection = $this->visitsService->get($params);
        $paginator = $this->paginate($visitsCollection['visits'],
                                     $visitsCollection['total'],
                                     $params['page_size'],
                                     $params['page'],
                                     ['path' => $request->url(), 'query' => $request->query()]);
        return view('visits', compact('paginator'));
    }

    public function paginate($items, $total_items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items, $total_items, $perPage, $page, $options);
    }

    public function getWithDefaults($params, $names)
    {
        $availabe = [];
        foreach ($names as $name => $value) {
            $availabe[$name] = $value;
        }
        foreach ($params as $name => $value) {
            $availabe[$name] = $value;
        }
        return $availabe;
    }


}
