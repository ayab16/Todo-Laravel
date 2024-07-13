<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store()
    {
        $todo = Todo::create($this->validateRequest());
    }
    public function update(Todo $todo)
    {
        $todo->update($this->validateRequest());
        return redirect("/MyTodos");
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect("/MyTodos");
    }

    protected function validateRequest()
    {
        return request()->validate([
            "label"=> 'required',
            "user"=> 'required',
        ]);
    } 
}
