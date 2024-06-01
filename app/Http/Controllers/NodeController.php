<?php

namespace App\Http\Controllers;

use App\Http\Requests\NodeCreateRequest;
use App\Http\Requests\NodeUpdateRequest;
use App\Models\Node;
use App\Services\ImageService;
use App\Services\NodesServices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NodeController extends Controller
{

    private readonly ImageService $imageServices;
    private readonly NodesServices $nodesServices;

    public function __construct(ImageService $imageServices, NodesServices $nodesServices)
    {
        $this->imageServices = $imageServices;
        $this->nodesServices = $nodesServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Node", [
            "nodes" => $this->nodesServices->getAllNodes()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NodeCreateRequest $request)
    {
        $imagePath = $this->imageServices->upload($request->file('image'));
        $node = Node::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        if (!$node) {
            return redirect()->back()->with('error', 'Failed to create node');
        }

        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NodeUpdateRequest $request, Node $node)
    {
        if ($request->hasFile('image')) {
            $this->imageServices->delete($node->image);

            $imagePath = $this->imageServices->upload($request->file('image'));
            $node->image = $imagePath;
        }

        $node = $node->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $node->image,
        ]);

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
