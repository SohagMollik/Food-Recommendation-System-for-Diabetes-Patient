<x-app-layout>
    <br>
<a href="{{ route('dashboard') }}" class="btn btn-primary" style="margin-left: 10px;">Back</a>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-striped table-sm">
            <thead>
            <h4 style="color:blueviolet">Breakfast(সকালের খাবার)</h4>
        <tr>
            <!-- <th>Food ID</th> -->
            <th>Food Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($breakfast as $temp)
            <tr>
                <td>{{ $temp->food_name }}</td>
            </tr>
        @endforeach
    </tbody>
            </table>
        </div>
        
        <div class="col">
            <table class="table table-striped table-sm">
            <thead>
            <h4 style="color:chocolate"> Lunch(দুপুরের খাবার)</h4>
        <tr>
            <!-- <th>Food ID</th> -->
            <th>Food Name</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($lunch as $temp)
            <tr>
                <td>{{ $temp->food_name }}</td>
            </tr>
        @endforeach
    </tbody>
            </table>
        </div>
        <div class="col">
            <table class="table table-striped table-sm">
            <thead>
            <h4 style="color:tomato">Dinner(রাতের খাবার)</h4>
        <tr>
            <!-- <th>Food ID</th> -->
            <th>Food Name</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($dinner as $temp)
            <tr>
                <td>{{ $temp->food_name }}</td>
            </tr>
        @endforeach
    </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="form-box">
                <form action="update_breakfastitems" method="POST">
                @csrf
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-left: 10px;">
                <h4 style="margin-left:50px;">Breakfast(সকালের খাবার)</h4>
                <select id="breakfastSelect" style="width: 75%" onchange="addToBox('breakfastSelect')">
                    @foreach ($foods1 as $item)
                        <option value="{{ $item->food_id }}">{{ $item->food_id }}. {{ $item->food_name }}</option>
                    @endforeach
                </select>
                <div class="selected-items-box">
                    <table class="table-striped">
                        <tbody id="breakfastBox"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="breakfastItems" id="breakfastItems"><br><br>
        <button id="submitBtn" type="submit" class="btn btn-success" style="margin-left: 13% ; display: block;">Update</button>
                </form>
            </div>
        </div>
        <div class="col">
            <div class="form-box">
                <form action="update_lunchitems" method="POST">
                @csrf
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-left: 10px;">
                <h3 style="margin-left:50px;">Lunch(দুপুরের খাবার)</h3>
                <select id="lunchSelect" style="width: 75%" onchange="addToBox('lunchSelect')">
                    @foreach ($foods2 as $item)
                        <option value="{{ $item->food_id }}">{{ $item->food_id }}. {{ $item->food_name }}</option>
                    @endforeach
                </select>
                <div class="selected-items-box">
                    <table class="table-striped">
                        <tbody id="lunchBox"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="lunchItems" id="lunchItems"><br><br>
        <button id="submitBtn" type="submit" class="btn btn-success" style="margin-left: 13% ; display: block;">Update</button>
                </form>
            </div>
        </div>
        <div class="col">
            <div class="form-box">
                <form action="update_dinneritems" method="POST">
                @csrf
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-left: 10px;">
                <h3 style="margin-left:50px;">Dinner(রাতের খাবার)</h3>
                <select id="dinnerSelect" style="width: 75%" onchange="addToBox('dinnerSelect')">
                    @foreach ($foods3 as $item)
                        <option value="{{ $item->food_id }}">{{ $item->food_id }}. {{ $item->food_name }}</option>
                    @endforeach
                </select>
                <div class="selected-items-box">
                    <table class="table-striped">
                        <tbody id="dinnerBox"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="dinnerItems" id="dinnerItems"><br><br>
        <button id="submitBtn" type="submit" class="btn btn-success" style="margin-left: 13% ; display: block;">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .form-box {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 20px;
}

</style>
 
    <script >
        function addToBox(selectId) {
            const selectElement = document.getElementById(selectId);
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const boxElement = document.getElementById(selectId.replace('Select', 'Box'));

            if (selectedOption.value === '') {
                return; // Ignore the default option
            }

            const selectedBoxItem = document.createElement('tr');
            selectedBoxItem.className = 'selected-item';

            const selectedItemText = document.createElement('td');
            selectedItemText.className = 'selected-item-text';
            selectedItemText.textContent = selectedOption.text;

            const selectedItemCross = document.createElement('td');
            selectedItemCross.className = 'selected-item-cross';
            selectedItemCross.innerHTML = '&#10060;'; // Cross icon (Unicode)

            selectedItemCross.onclick = function () {
                selectedBoxItem.remove();
                selectElement.selectedIndex = 0;
                updateHiddenInput(selectId.replace('Select', 'Items'), getBoxItems(selectId.replace('Select', 'Box')));
            };

            selectedBoxItem.appendChild(selectedItemText);
            selectedBoxItem.appendChild(selectedItemCross);
            boxElement.appendChild(selectedBoxItem);
            selectElement.selectedIndex = 0;

            updateHiddenInput(selectId.replace('Select', 'Items'), getBoxItems(selectId.replace('Select', 'Box')));
        }

        function getBoxItems(boxId) {
            const boxElement = document.getElementById(boxId);
            return Array.from(boxElement.children).map((item) => item.firstChild.textContent.trim().split('. ')[0]);
        }

        function updateHiddenInput(inputId, items) {
            const hiddenInput = document.getElementById(inputId);
            hiddenInput.value = JSON.stringify(items);
        }
    </script>
    
</x-app-layout>
