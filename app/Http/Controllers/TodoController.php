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
    }

    public function validateRequest()
    {
        return request()->validate([
            "label"=> 'required',
            "user"=> 'required',
        ]);
    } 
}
