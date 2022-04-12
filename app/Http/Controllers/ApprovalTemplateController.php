<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class ApprovalTemplateController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'master/approvalSetting');
        $response = json_decode($response->body());
        $approvalTemplate = $response->data;
        if($response->success) {
            return view('dashboard.pages.approval-template.index', compact('approvalTemplate'));
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
        $users = Http::get($this->url_dynamic() . 'users');
        $users = json_decode($users->body());
        $users = $users->data;
        
        $approvalTemplate = (object) [
            'id' => '',
            'data' => 0,
            'name' => '',
            'approver_one_id' => '',
            'approver_two_id' => '',
            'approver_three_id' => '',
            'type' => ''
        ];
        
        return view('dashboard.pages.approval-template.form', compact('approvalTemplate', 'users'));
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
            'name' => 'required'
        ])->validate();
        
        $response = Http::post($this->url_dynamic() . 'master/approvalSetting', [
            'name' => $request->name,
            'approver_one' => $request->approver_one,
            'approver_two' => $request->approver_two,
            'approver_three' => $request->approver_three,
            'type' => $request->type,
            'createdBy' => session()->get('userId'),
            'updatedBy' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('approval-template.index')->with('status', $response->message);
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
        $response = Http::get($this->url_dynamic() . 'master/approvalSetting/' . $id);
        $response = json_decode($response->body());
        $approvalTemplate = $response->data['0'];
        
        $users = Http::get($this->url_dynamic() . 'users');
        $users = json_decode($users->body());
        $users = $users->data;
        
        if($response->success) {
            return view('dashboard.pages.approval-template.form', compact('approvalTemplate', 'users'));
        } else {
            return redirect()->back()->with('error', $response->message);
        }
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
            'name' => 'required'
        ])->validate();
        
        $response = Http::patch($this->url_dynamic() . 'master/approvalSetting/' . $id, [
            'name' => $request->name,
            'approver_one' => $request->approver_one,
            'approver_two' => $request->approver_two,
            'approver_three' => $request->approver_three,
            'type' => $request->type,
            'updatedBy' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('approval-template.index')->with('status', $response->message);
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
        $response = Http::delete($this->url_dynamic() . 'master/approvalSetting/' . $id, [
            'deleted_by' => session()->get('userId'),
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
