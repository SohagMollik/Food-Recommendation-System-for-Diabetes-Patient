<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<br>
<div class="d-flex justify-content-center">
                                    <marquee direction="left">
                                        <h3><b>Welcome to Food Recommendation System</b></h3>
                                    </marquee>
</div><br><br>
<div class="panel-heading">
            <h2 class="text-center mt-3" style="color:darkorange">Food Recommended for you</h2>
    </div><br>
<?php if((Auth::user()->status)==1): ?>

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
        <?php $__currentLoopData = $foods1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- <td><?php echo e($temp->food_id); ?></td> -->
                <td><?php echo e($temp->food_name); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php $__currentLoopData = $foods2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- <td><?php echo e($temp->food_id); ?></td> -->
                <td><?php echo e($temp->food_name); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php $__currentLoopData = $foods3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <!-- <td><?php echo e($temp->food_id); ?></td> -->
                <td><?php echo e($temp->food_name); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
            </table>
        </div>
    </div>
</div>




<?php else: ?>
    <h3 style="margin-top: 50px; margin-left: 20px; text-align:center;">Select food which you don't want to take from this list</h3>
    <br><br>
    <form action="store_items" method="POST">
        <?php echo csrf_field(); ?>
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex: 1; margin-left: 10px;">
                <h3 style="margin-left:50px;">Breakfast(সকালের খাবার)</h3>
                <select id="breakfastSelect" style="width: 30%" onchange="addToBox('breakfastSelect')">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->food_id); ?>"><?php echo e($item->food_id); ?>. <?php echo e($item->food_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php endif; ?>    
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
    
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH F:\Softwar\XAMPP\htdocs\food\resources\views/dashboard.blade.php ENDPATH**/ ?>