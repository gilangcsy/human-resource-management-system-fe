<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;

class ApprovalAuthorization extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get($this->url_dynamic() . 'approvalAuthorization');
        $response = json_decode($response->body());
        $approvalAuthorization = $response->data;
        if($response->success) {
            return view('dashboard.pages.approval-authorization.index', compact('approvalAuthorization'));
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
        $response = Http::get($this->url_dynamic() . 'master/approvalTemplate');
        $response = json_decode($response->body());
        $approvalTemplate = $response->data;
        
        $response2= Http::get($this->url_dynamic() . 'master/role');
        $response2 = json_decode($response2->body());
        $roles = $response2->data;

        $approvalAuthorization = (object) [
            'id' => '',
            'data' => 0,
            'role_id' => '',
            'approval_template_id' => '',
            'approval_template_type' => ''
        ];
        
        return view('dashboard.pages.approval-authorization.form', compact('approvalTemplate', 'roles', 'approvalAuthorization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::post($this->url_dynamic() . 'approvalAuthorization', [
            'RoleId' => $request->RoleId,
            'ApprovalTemplateId' => $request->ApprovalTemplateId,
            'createdBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('approval-authorization.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message)->withInput();
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
        $response = Http::get($this->url_dynamic() . 'master/approvalTemplate');
        $response = json_decode($response->body());
        $approvalTemplate = $response->data;
        
        $response2= Http::get($this->url_dynamic() . 'master/role');
        $response2 = json_decode($response2->body());
        $roles = $response2->data;

        $response3= Http::get($this->url_dynamic() . 'approvalAuthorization/' . $id);
        $response3 = json_decode($response3->body());
        $approvalAuthorization = $response3->data['0'];
        
        return view('dashboard.pages.approval-authorization.form', compact('approvalTemplate', 'roles', 'approvalAuthorization'));
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
        $response = Http::patch($this->url_dynamic() . 'approvalAuthorization/' . $id, [
            'RoleId' => $request->RoleId,
            'ApprovalTemplateId' => $request->ApprovalTemplateId,
            'updatedBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->route('approval-authorization.index')->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message)->withInput();
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
        $response = Http::delete($this->url_dynamic() . 'approvalAuthorization/' . $id, [
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
