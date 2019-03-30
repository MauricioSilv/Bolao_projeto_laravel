<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($modelAll as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>
                <a href="{{route('users.show', $item->id)}}"><i style="color:#0400ff" class="material-icons">pageview</i></a>
                <a href="{{route('users.edit',$item->id)}}"><i style="color:orange" class="material-icons">edit</i></a>
                <a href="{{route('users.show', [$item->id, 'delete=1'])}}"><i style="color:red" class="material-icons">delete</i></a>
                </td>
            </tr>
        @endforeach
            
    </tbody>
</table>