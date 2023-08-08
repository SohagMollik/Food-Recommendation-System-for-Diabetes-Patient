<x-admin-layout>
    <x-slot name="header">
<div class="container">
                  <div class="panel-heading">
                      <h2 class="text-center mt-3">User List</h2>
                  </div>
                  <!-- Table Start -->
                  <div>
                    <form class="col-5">
                    @csrf
                        <input class="form control" name="search" type="Number" placeholder="Mobile Number" aria-label="search">
                        <button class="btn btn-success" type="submit">Search</button>
                        <a href="{{ route('admin.newusers') }}">
                        <button class="btn btn-primary " type="button">
                            Reset
                        </button>
                        </a>
                    </form><br>
                  </div>
                <div>
                    <table id="" class="table table-striped table-bordered">
                        <thead class="table-success text-center">
                            <tr>
                                <th>S.L</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->phone}}</td>
                               <form action="deleteusers" method="POST">
                               @csrf
                                    <td class="text-center">
                                        <button class="btn btn-danger" type="submit" name="delete[{{$row->id}}]" value="{{$row->id}}" />Delete</button>
                                    </td>
                               </form> 
                            </tr>
                        @endforeach
                        </tbody>
                    </table>	  
                </div>
                <!-- Table End -->
    </div>
    </x-slot>
</x-admin-layout>
