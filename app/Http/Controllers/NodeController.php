<?php

namespace App\Http\Controllers;

use App\Http\Requests\NodeRequest;
use App\Models\Node;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Node", [
            "nodes" =>Node::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NodeRequest $request)
    {
        $node = Node::create($request->validated());

        if (!$node) {
            return redirect()->back()->with('error', 'Failed to create node');
        }

        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NodeRequest $request, Node $node)
    {
        $node = $node->update($request->validated());

        if (!$node) {
            return redirect()->back()->with('error', 'Failed to update node');
        }

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Node $node)
    {
        Node::destroy($node->id);

        return $this->index();
    }
}
