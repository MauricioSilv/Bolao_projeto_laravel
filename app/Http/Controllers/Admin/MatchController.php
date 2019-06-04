<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use Validator;

class MatchController extends Controller
{
    protected $model;
    protected $route = "matches";

    public function __construct(MatchRepositoryInterface $model)
    {   
        $this->model = $model;
    }

    public function index(MatchRepositoryInterface $model, Request $request)
    {

        $search = '';
        $routeName = $this->route;
        $columnList = [
            'id'=>'#',
            'title'=>'Title',
            'stadium' =>'Stadium',
            'team_a' => 'Team A',
            'team_b' => 'Team B',
            'result' => 'Results',
            'scoreboard_a' => 'C.Goals A',
            'scoreboard_b' => 'C.Goals B',
            'date' => 'Date'
        ];

        if(isset($request->search))
        {
           $search = $request->search;
           $list = $model->finWhereLike(['title','team_a','team_b'],$search, 'id', 'DESC');
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
        $listRel = $user->rounds;
    


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
            'stadium' => ['required'],
            'round_id'=> ['required'],
            'team_a' => ['required'],
            'team_b' => ['required'],
            'result' => ['required'],
            'scoreboard_a' => ['required'],
            'scoreboard_b' => ['required'],
            'date' => ['required'],
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
        $listRel = $user->rounds;
        $register_id = $register->round_id;

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
            'stadium' => ['required'],
            'team_a' => ['required'],
            'team_b' => ['required'],
            'result' => ['required'],
            'scoreboard_a' => ['required'],
            'scoreboard_b' => ['required'],
            'date' => ['required'],
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
