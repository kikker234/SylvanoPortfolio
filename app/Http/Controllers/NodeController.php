<?php

namespace App\Http\Controllers;

use App\Http\Requests\NodeRequest;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Node::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NodeRequest $request)
    {
        $node = Node::create($request->validated());

        return inertia('Node', [
            'node' => $node,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NodeRequest $request, Node $node)
    {
        $node->update($request->validated());

        return inertia('Node', [
            'node' => $node,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node)
    {
        Node::destroy($node->id);
    }
}
