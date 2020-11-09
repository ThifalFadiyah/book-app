<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use \Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorsController extends Controller
{
    public function index()
    {
        return response()->json([
            Authors::all()
        ], 200);
    }

    public function showById($id)
    {
        $author = Authors::where('id', $id)->first();
        if ($author) {
            return response()->json([
                'message' => 'show authors by id',
                'data' => $author
            ], 201);
        } else {
            return response()->json([
                'message' => 'author not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required',
            'biography' => 'required'
        ]);
        $author = Authors::create(
            $request->only(['name', 'gender', 'biography'])
        );

        return response()->json([
            'created' => true,
            'data' => $author
        ], 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $author = Authors::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'messsage' => 'author not found'
            ], 404);
        }

        $author->fill(
            $request->only(['name', 'gender', 'biography'])
        );

        $author->save();

        return response()->json([
            'updated' => true,
            'data' => $author
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $author = Authors::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'message' => 'author not found'
                ]
            ], 404);
        }

        $author->delete();

        return response()->json([
            'deleted' => true
        ], 200);
    }
}
