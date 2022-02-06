<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Generator;
use Illuminate\Container\Container;
use App\Services\VisitsService;

class FallbackController extends Controller
{
    protected $visitsService;

    public function __construct(VisitsService $visitsService)
    {
        $this->visitsService = $visitsService;
    }

    public function index(Request $request)
    {
        $data = ['url' => $request->url()];
        $this->visitsService->add($data);
        $faker = Container::getInstance()->make(Generator::class);
        $url = $faker->lexify('?.html');
        return view('fallback', ['url' => $url]);
    }


}
