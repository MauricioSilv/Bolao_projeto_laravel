<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BettingRepositoryInterface;
use Validator;

class BettingController extends Controller
{
    protected $model;
    protected $route = "betting";

    public function __construct(BettingRepositoryInterface $model)
    {   
        $this->model = $model;
    }

    public function index(BettingRepositoryInterface $model, Request $request)
    {

        $search = '';
        $routeName = $this->route;
        $columnList = [
            'id'=>'#',
            'title'=>'Title',
            'user_name' =>'Name',
            'current_round'=>'Current round',
            'value_result' =>'Value result',
            'extra_value' => 'Extra value',
            'value_fee' => 'Value fee'
        ];

        if(isset($request->search))
        {
           $search = $request->search;
           $list = $model->finWhereLike(['title'],$search, 'id', 'DESC');
        }else{
            $list = $model->paginate(10, 'id','DESC');
        }

        //session()->flash('msg', 'Task was successful!');
        //session()->flash('status', 'danger');

        return view('admin.'.$routeName.'.index', compact('list','search', 'routeName', 'columnList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routeName = $this->route;
        return view('admin.'.$routeName.'.create', compact('routeName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'value_result' => ['required'],
            'extra_value' => ['required'],
            'value_fee' => ['required']
        ]);
        
        if($this->model->create($data))
        {
            session()->flash('msg', 'Task was successful!');
            session()->flash('status', 'success');

            return redirect()->back();
        }else{
            session()->flash('msg', 'Error!');
            session()->flash('status', 'danger');

            return redirect()->back();
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $routeName = $this->route;

        $register = $this->model->find($id);
        if($register)
        {
            if(!isset($request->delete))
            {
                $delete = false;
            }else{
                session()->flash('msg', 'Delete this record?');
                session()->flash('status', 'info');
                $delete = true;
            }

            return view('admin.'.$routeName.'.show', compact('register','delete', 'routeName'));
        }else{
            return redirect()->route($routeName.'.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routeName = $this->route;

        $register = $this->model->find($id);
        if($register)
        {
            return view('admin.'.$routeName.'.edit', compact('register', 'routeName'));
        }else{
            return redirect()->route($routeName.'.index');
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
        $data = $request->all();

        Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'value_result' => ['required'],
            'extra_value' => ['required'],
            'value_fee' => ['required']
        ])->validate();

        if($this->model->update($id, $data))
        {
            session()->flash('msg', 'Task was successful!');
            session()->flash('status', 'success');

            return redirect()->back();
        }else{
            session()->flash('msg', 'Error!');
            session()->flash('status', 'danger');

            return redirect()->back();
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
        $routeName = $this->route;
        $register = $this->model->find($id);

        $register->delete();

        if($register)
        {
            session()->flash('msg', 'Deleting was successful!');
            session()->flash('status', 'success');
        }else{
            session()->flash('msg', 'Error!');
            session()->flash('status', 'danger');
        }

        return redirect()->route($routeName.'.index');
    }
}
