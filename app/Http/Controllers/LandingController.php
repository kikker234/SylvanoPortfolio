<?php

namespace App\Http\Controllers;

use App\Services\NodesServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingController extends Controller
{
    private NodesServices $nodeServices;

    public function __construct(NodesServices $nodeServices)
    {
        $this->nodeServices = $nodeServices;
    }

    public function index()
    {
        return Inertia::render("Landing", [
            "nodes" => $this->nodeServices->getAllNodes()
        ]);
    }
}
