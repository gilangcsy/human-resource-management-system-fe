<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class TaskManagementController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'All Task';
        $url = strtolower(str_replace(" ","-", $page));
        $editRoute = 'all-task.edit';
        $destroyRoute = 'all-task.destroy';
        $token = session()->get('token');

        $tasks = Http::withHeaders([
            'x-access-token' => $token
        ])->get($this->url_dynamic() . 'tasks');
        $tasks = json_decode($tasks->body());
        
        if($tasks->message == 'Unauthorized!') {
            return redirect()->route('auth.logout');
        }

        if($tasks->success) {
            $tasks = $tasks->data;
            return view('dashboard.pages.task-management.index', compact('tasks', 'page', 'url', 'editRoute', 'destroyRoute'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function my_task() {
        $editRoute = 'my-task.edit';
        $destroyRoute = 'my-task.destroy';
        $token = session()->get('token');
        $userId = session()->get('userId');

        $tasks = Http::withHeaders([
            'x-access-token' => $token
        ])->get($this->url_dynamic() . 'tasks/readByUser/' . $userId);
        $tasks = json_decode($tasks->body());
        
        if($tasks->message == 'Unauthorized!') {
            return redirect()->route('auth.logout');
        }

        $page = 'My Task';
        $url = strtolower(str_replace(" ","-", $page));

        if($tasks->success) {
            $tasks = $tasks->data->myTask;
            return view('dashboard.pages.task-management.index', compact('tasks', 'page', 'url', 'editRoute', 'destroyRoute'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function create_my_task() {
        $page = 'My Task';
        $route = 'my-task.store';
        $url = strtolower(str_replace(" ","-", $page));
        
        $task = (object) [
            'page' => $page,
            'url' => $url,
            'route' => $route,
            'id' => '',
            'data' => 0,
            'name' => '',
            'description' => '',
            'startDate' => '',
            'endDate' => '',
            'assignTo' => '',
            'priority' => '',
            'status' => '',
            'ownerId' => ''
        ];
        
        $users = Http::get($this->url_dynamic() . 'users');
        $users = json_decode($users->body());
        $users = $users->data;
        
        return view('dashboard.pages.task-management.form', compact('task', 'users'));
    }

    public function store_my_task(Request $request) {
        
        Validator::make($request->all(), [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->post($this->url_dynamic() . 'tasks', [
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'priority' => $request->priority,
            'status' => $request->status,
            'assignTo' => session()->get('userId'),
            'ownerId' => session()->get('userId'),
            'createdBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('my-task.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function edit_my_task($id) {
        $roles = Http::get($this->url_dynamic() . 'master/role/readBySuperiorId/' . session()->get('role_id'));
        $roles = json_decode($roles->body());
        $roles = $roles->data;
        
        $task = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'tasks/' . $id);
        $task = json_decode($task->body());
        $task = $task->data;

        $task->page = 'My Task';
        $task->route = 'my-task.update';
        $task->url = strtolower(str_replace(" ","-", 'My Task'));

        return view('dashboard.pages.task-management.form', compact('task', 'roles'));
    }

    public function destroy_my_task($id) {
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->delete($this->url_dynamic() . 'tasks/' . $id, [
            'deletedBy' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function update_my_task(Request $request, $id) {
        Validator::make($request->all(), [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->patch($this->url_dynamic() . 'tasks/' . $id, [
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'priority' => $request->priority,
            'status' => $request->status,
            'assignTo' => session()->get('userId'),
            'ownerId' => session()->get('userId'),
            'updatedBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('my-task.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function member_task() {
        $editRoute = 'member-task.edit';
        $destroyRoute = 'member-task.destroy';
        $page = 'Member Task';
        $url = strtolower(str_replace(" ","-", $page));
        $token = session()->get('token');
        $userId = session()->get('userId');

        $tasks = Http::withHeaders([
            'x-access-token' => $token
        ])->get($this->url_dynamic() . 'tasks/readByUser/' . $userId);
        $tasks = json_decode($tasks->body());
        
        if($tasks->message == 'Unauthorized!') {
            return redirect()->route('auth.logout');
        }

        if($tasks->success) {
            $tasks = $tasks->data->memberTask;
            return view('dashboard.pages.task-management.index', compact('tasks', 'page', 'url', 'editRoute', 'destroyRoute'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function create_member_task() {
        $page = 'Member Task';
        $route = 'member-task.store';
        $url = strtolower(str_replace(" ","-", $page));
        
        $task = (object) [
            'page' => $page,
            'url' => $url,
            'route' => $route,
            'id' => '',
            'data' => 0,
            'name' => '',
            'description' => '',
            'startDate' => '',
            'endDate' => '',
            'assignTo' => '',
            'priority' => '',
            'status' => '',
            'ownerId' => ''
        ];
        
        $roles = Http::get($this->url_dynamic() . 'master/role/readBySuperiorId/' . session()->get('role_id'));
        $roles = json_decode($roles->body());
        $roles = $roles->data;
        
        return view('dashboard.pages.task-management.form', compact('task', 'roles'));
    }

    public function edit_member_task($id) {
        $roles = Http::get($this->url_dynamic() . 'master/role/readBySuperiorId/' . session()->get('role_id'));
        $roles = json_decode($roles->body());
        $roles = $roles->data;
        
        $task = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'tasks/' . $id);
        $task = json_decode($task->body());
        $task = $task->data;

        $task->page = 'Member Task';
        $task->route = 'member-task.update';
        $task->url = strtolower(str_replace(" ","-", 'Member Task'));

        return view('dashboard.pages.task-management.form', compact('task', 'roles'));
    }

    public function destroy_member_task($id) {
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->delete($this->url_dynamic() . 'tasks/' . $id, [
            'deletedBy' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function store_member_task(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->post($this->url_dynamic() . 'tasks', [
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'priority' => $request->priority,
            'status' => $request->status,
            'assignTo' => $request->assignTo,
            'ownerId' => session()->get('userId'),
            'createdBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('member-task.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    public function update_member_task(Request $request, $id) {
        Validator::make($request->all(), [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->patch($this->url_dynamic() . 'tasks/' . $id, [
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'priority' => $request->priority,
            'status' => $request->status,
            'assignTo' => $request->assignTo,
            'ownerId' => session()->get('userId'),
            'updatedBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('all-task.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'All Task';
        $route = 'all-task.store';
        $url = strtolower(str_replace(" ","-", $page));
        
        $task = (object) [
            'page' => $page,
            'url' => $url,
            'route' => $route,
            'id' => '',
            'data' => 0,
            'name' => '',
            'description' => '',
            'startDate' => '',
            'endDate' => '',
            'assignTo' => '',
            'priority' => '',
            'status' => '',
            'ownerId' => ''
        ];
        
        $roles = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'master/role');
        $roles = json_decode($roles->body());
        $roles = $roles->data;
        
        return view('dashboard.pages.task-management.form', compact('task', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->post($this->url_dynamic() . 'tasks', [
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'priority' => $request->priority,
            'status' => $request->status,
            'assignTo' => $request->assignTo,
            'ownerId' => $request->ownerId,
            'createdBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('all-task.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'tasks/' . $id);
        $task = json_decode($task->body());
        $task = $task->data;

        $task->page = 'All Task';
        $task->route = 'all-task.update';
        $task->url = strtolower(str_replace(" ","-", 'All Task'));
        
        $roles = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'master/role');
        $roles = json_decode($roles->body());
        $roles = $roles->data;
        
        return view('dashboard.pages.task-management.form', compact('task', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'priority' => 'required',
            'status' => 'required'
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->patch($this->url_dynamic() . 'tasks/' . $id, [
            'name' => $request->name,
            'description' => $request->description,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'priority' => $request->priority,
            'status' => $request->status,
            'assignTo' => $request->assignTo,
            'ownerId' => $request->ownerId,
            'updatedBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('all-task.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->delete($this->url_dynamic() . 'tasks/' . $id, [
            'deletedBy' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
