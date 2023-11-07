<x-admin-master>
    @section('content')
    <div class="row">
        <div class="col-sm-3">
            <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
            <div class="col-sm-9">
                

            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="Role" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Delete</th>
                          
                            
                        </tr>

                   </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Delete</th>
                           
                        </tr>
                        </tfoot>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                    <form  method="post" action="{{ route ('roles.destroy', $role->id)}}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        


            </div>
        </div>


    </div>
    
            
    @endsection
</x-admin-master>
