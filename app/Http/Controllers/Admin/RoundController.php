<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoundRepositoryInterface;
use Validator;

class RoundController extends Controller
{
    protected $model;
    protected $route = "rounds";

    public function __construct(RoundRepositoryInterface $model)
    {   
        $this->model = $model;
    }

    public function index(RoundRepositoryInterface $model, Request $request)
    {

        $search = '';
        $routeName = $this->route;
        $columnList = [
            'id'=>'#',
            'title'=>'Title',
            'betting_title' =>'Aposta',
            'date_start_site' => 'Data inicio',
            'date_end_site' => 'Data fim'
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
        $user = auth()->user();
        $listRel = $user->bettings;


        return view('admin.'.$routeName.'.create', compact('routeName','listRel'));
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
            'betting_id' => ['required'],
            'date_start' => ['required'],
            'date_end' => ['required']
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
        $register = $this->model->find($id);
        $routeName = $this->route;
        $user = auth()->user();
        $listRel = $user->bettings;
        $register_id = $register->betting_id;

        if($register)
        {
            return view('admin.'.$routeName.'.edit', compact('register', 'routeName','listRel','register_id'));
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
            'betting_id' => ['required'],
            'date_start' => ['required'],
            'date_end' => ['required']
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
