<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Validator;

class RoleController extends Controller
{
    protected $model;
    protected $route = "roles";
    protected $modelPermission;

    public function __construct(RoleRepositoryInterface $model, PermissionRepositoryInterface $modelPermission)
    {   
        $this->model = $model;
        $this->modelPermission = $modelPermission;
    }

    public function index(RoleRepositoryInterface $model, Request $request)
    {

        $search = '';
        $routeName = $this->route;
        $columnList = ['id'=>'#','name'=>'name','description'=>'description'];

        if(isset($request->search))
        {
           $search = $request->search;
           $list = $model->finWhereLike(['name','description'],$search, 'id', 'DESC');
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

        $permissions = $this->modelPermission->all('name');
        $routeName = $this->route;
        return view('admin.'.$routeName.'.create', compact('routeName','permissions'));
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
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
        $permissions = $this->modelPermission->all('name');

        $register = $this->model->find($id);
        if($register)
        {
            return view('admin.'.$routeName.'.edit', compact('register', 'routeName','permissions'));
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
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
