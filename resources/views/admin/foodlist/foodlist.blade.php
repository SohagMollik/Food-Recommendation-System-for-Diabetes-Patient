<x-admin-layout>
    <x-slot name="header">
    <div class="container">
    <div class="row">
        <div class="col">
            <div class="table-box">
                <table class="table table-striped table-sm">
                    <thead>
                        <h4 style="color:blueviolet">Food List</h4>
                        <tr>
                            <th>Food ID</th>
                            <th>Food Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foodlist as $temp)
                        <tr>
                            <td>{{ $temp->food_id }}</td>
                            <td>{{ $temp->food_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<style>
.table-box {
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
</style>


    </x-slot>
</x-admin-layout>
