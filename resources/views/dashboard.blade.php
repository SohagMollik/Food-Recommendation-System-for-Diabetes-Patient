<x-app-layout>
<br>
<div class="d-flex justify-content-center">
                                    <marquee direction="left">
                                        <h3><b>Welcome to Food Recommendation System</b></h3>
                                    </marquee>
</div><br><br>
<div class="panel-heading">
            <h2 class="text-center mt-3" style="color:darkorange">Food Recommended for you</h2>
    </div><br>
@if((Auth::user()->status)==1)

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
        @foreach ($foods1 as $temp)
            <tr>
                <!-- <td>{{ $temp->food_id }}</td> -->
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
        @foreach ($foods2 as $temp)
            <tr>
                <!-- <td>{{ $temp->food_id }}</td> -->
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
        @foreach ($foods3 as $temp)
            <tr>
                <!-- <td>{{ $temp->food_id }}</td> -->
                <td>{{ $temp->food_name }}</td>
            </tr>
        @endforeach
    </tbody>
            </table>
        </div>
    </div>
</div>




@else
    <h3 style="margin-top: 50px; margin-left: 20px; text-align:center;">Select food which you don't want to take from this list</h3>
    <br><br>
    <form action="store_items" method="POST">
        @csrf
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-left: 10px;">
                <h3 style="margin-left:50px;">Breakfast(সকালের খাবার)</h3>
                <select id="breakfastSelect" style="width: 30%" onchange="addToBox('breakfastSelect')">
                    @foreach ($data as $item)
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
        <button id="submitBtn" type="submit" class="btn btn-success" style="margin-left: 13% ; display: block;">Next</button>
    </form>

@endif    
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
