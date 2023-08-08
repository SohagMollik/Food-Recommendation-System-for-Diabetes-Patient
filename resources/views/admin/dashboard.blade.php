<x-admin-layout>
<x-slot name="header">
    <div class="panel-heading">
            <h2 class="text-center mt-3">Food Recommendation System</h2>
    </div>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col" class="text-center">S.L</th>
      <th scope="col" class="text-center">Details</th>
      <th scope="col" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row" class="text-center">1</th>
      <td>Users List</td>
      <td class="text-center"><a href="{{ route('admin.newusers') }}" class="btn btn-primary">
      View  
    </a>
      </td>
    </tr>
    <tr>
      <th scope="row" class="text-center">2</th>
      <td>Update Food List</td>
      <td class="text-center"><a href="{{ route('admin.foodlist') }}" class="btn btn-success">View </a> 
      </td>
    </tr>
  </tbody>
</table>
</div>
    </x-slot>
</x-admin-layout>
