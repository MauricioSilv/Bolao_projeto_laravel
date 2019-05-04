<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Validator;
use App\User;
use Illuminate\Validation\Rule;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{
    protected $model;
    protected $route = "users";
    protected $modelRole;

    public function __construct(UserRepositoryInterface $model, RoleRepositoryInterface $modelRole)
    {   
        $this->model = $model;
        $this->modelRole = $modelRole;
    }

    public function index(UserRepositoryInterface $model, Request $request)
    {

        $search = '';
        $routeName = $this->route;
        $columnList = ['id'=>'#','name'=>'name','email'=>'e-mail'];
        

        //tratando msgs de erro de autorização
        if(Gate::denies('list-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

        if(isset($request->search))
        {
           $search = $request->search;
           $list = $model->finWhereLike(['name','email'],$search, 'id', 'DESC');
        }else{
            $list = $model->paginate(10, 'id','DESC');
        }

        //session()->flash('msg', 'Task was successful!');
        //session()->flash('status', 'danger');
        return view('admin.'.$routeName.'.index', compact('list','search', 'routeName','columnList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         if(Gate::denies('create-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

        $roles = $this->modelRole->all();
        $routeName = $this->route;

        return view('admin.'.$routeName.'.create', compact('routeName','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(Gate::denies('create-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        if(Gate::denies('show-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

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
        if(Gate::denies('edit-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

        $routeName = $this->route;
        $roles = $this->modelRole->all();

        $register = $this->model->find($id);
        if($register)
        {
            return view('admin.'.$routeName.'.edit', compact('register','routeName','roles'));
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

        if(Gate::denies('edit-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

        $data = $request->all();

        if(!$data['password'])
        {
            unset($data['password']);
        }

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'password' => ['sometimes','required', 'string', 'min:8', 'confirmed'],
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
        if(Gate::denies('delete-user'))
        {
            session()->flash('msg', 'Acesso negado!');
            session()->flash('status', 'danger');

            return redirect()->route('home');
        }

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
