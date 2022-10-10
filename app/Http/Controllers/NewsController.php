<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\UrlTrait;
use Illuminate\Support\Facades\Http;
use Validator;


class NewsController extends Controller
{
    use UrlTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'news');
        $news = json_decode($news->body());
        if($news->success) {
            $news = $news->data;
            $urlStorage = $this->url_storage();
            return view('dashboard.pages.news.index', compact('news', 'urlStorage'));
        } else {
            return redirect()->back()->with('error', $news->message);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = (object) [
            'id' => '',
            'data' => 0,
            'title' => '',
            'content' => '',
            'thumbnail' => '',
            'isActive' => ''
        ];

        return view('dashboard.pages.news.form', compact('news'));
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
            'title' => 'required',
            'content' => 'required',
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ]);

        if($request->file('thumbnail')) {
            $response = $response->attach('thumbnail', file_get_contents($request->file('thumbnail')), $request->file('thumbnail')->getClientOriginalName());
        }
        
        $response = $response->post($this->url_dynamic() . 'news', [
            'title' => $request->title,
            'content' => $request->content,
            'UserId' => session()->get('userId')
        ]);

        $response = json_decode($response->body());

        if($response->success) {
            return redirect()->route('news.index')->with('status', $response->message);
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
        $urlStorage = $this->url_storage();

        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ])->get($this->url_dynamic() . 'news/' . $id);
        $response = json_decode($response->body());
        
        if($response->success) {
            
            $news = $response->data;
            return view('dashboard.pages.news.form',compact('news', 'urlStorage'));
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
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'max:1024', //1024kb or 1mb
        ])->validate();
        
        $response = Http::withHeaders([
            'x-access-token' => session()->get('token')
        ]);

        if($request->file('thumbnail')) {
            $response = $response->attach('thumbnail', file_get_contents($request->file('thumbnail')), $request->file('thumbnail')->getClientOriginalName());
        }
        
        $response = $response->patch($this->url_dynamic() . 'news/' . $id, [
            'title' => $request->title,
            'content' => $request->content,
            'updatedBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());

        if($response->success) {
            return redirect()->route('news.index')->with('status', $response->message);
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
        ])->delete($this->url_dynamic() . 'news/' . $id, [
            'deletedBy' => session()->get('userId')
        ]);

        $response = json_decode($response->body());
        if($response->success) {
            return redirect()->back()->with('status', $response->message);
        } else {
            return redirect()->back()->with('error', $response->message);
        }
    }
}
