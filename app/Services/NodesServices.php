<?php

namespace App\Services;

use App\Models\Node;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class NodesServices
{
    public function getAllNodes(): Collection
    {
        $nodes = Node::all();

        foreach ($nodes as $node) {
            // image is stored as: images/h6hP3DyylqdyAz2Ed0abafBaqUEDEh37V5VRQ5uy.jpg
            // needs to be accessible by Vue frontend
            $node->image = Storage::url($node->image);
        }

        return $nodes;
    }
}
