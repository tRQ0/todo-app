<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Models\Todo;
use App\Models\Category;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::with('todos')->get();
        return view('index')->with(['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'todoItem' => 'required|',
            'category' => 'required'
        ]);
        $todo = Todo::create([
            'name' => $validatedData['todoItem'],
            'category_id' => $validatedData['category'],
        ]);

        $todo = collect($todo);
        $categoryName = Category::where('id', $request['category'])->pluck('name')->get(0);
        $timestamp = Todo::where('id', $todo->get('id'))->pluck('timestamp')->get(0);
        $timestamp = date_format($timestamp, 'dS F');
        
        $todo = $todo -> merge([
            'timestamp' => $timestamp,
            'category_name' => $categoryName
        ]);
        
        return Response::json($todo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        if($request->ajax()) {
            return response(['msg' => 'success']);
        }
       return redirect()->route('home')->with('message', 'Task deleted!');
    }
}
