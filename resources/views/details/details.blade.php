<x-app-layout>
    <h3 style="margin-top: 50px; margin-left: 20px; text-align:center;">Select food which you don't want to take</h3>
    <br><br>
    <form action="store_items" method="POST">
        @csrf
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-left: 10px;">
                <h3 style="text-align:center;">Breakfast (সকালের খাবার)</h3>
                <select id="breakfastSelect" style="width: 100%" onchange="addToBox('breakfastSelect')">
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
        <input type="hidden" name="breakfastItems" id="breakfastItems">
        <button id="submitBtn" type="submit" class="btn btn-primary" style="margin: 20px auto; display: block;">Submit</button>
    </form>
    <script>
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
