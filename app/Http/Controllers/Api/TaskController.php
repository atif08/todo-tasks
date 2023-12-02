<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Queries\TaskIndexQuery;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{

    public function index(): JsonResponse
    {
        $query = new TaskIndexQuery();
        return response()->json($query->paginate());
    }



    public function store():JsonResponse
    {
        $task = Task::create($this->validateRule()+['user_id'=>request()->user()->id]);

        return response()->json($task,201);
    }

    public function show (Task $task): JsonResponse
    {
        return response()->json($task);
    }


    public function update(Task $task):JsonResponse
    {

        $task = $task->update($this->validateRule()+['user_id'=>request()->user()->id]);

        if($task){

            return response()->json(["message"=>"Task Updated successfully"]);
        }

        return response()->json(["message"=>"Error on updating the task"],500);
    }

    public function destroy (Task $task): JsonResponse
    {
        $task->delete();
        return response()->json(["message"=>"Task deleted successfully"],204);
    }

    protected function validateRule(?Task $feedback = null): array
    {
        $feedback ??= new Task();

        return request()->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    }
}
