<?php if (isset($component)) { $__componentOriginal91fdd17964e43374ae18c674f95cdaa3 = $component; } ?>
<?php $component = App\View\Components\AdminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('admin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AdminLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
<div class="container">
                  <div class="panel-heading">
                      <h2 class="text-center mt-3">User List</h2>
                  </div>
                  <!-- Table Start -->
                  <div>
                    <form class="col-5">
                    <?php echo csrf_field(); ?>
                        <input class="form control" name="search" type="Number" placeholder="Mobile Number" aria-label="search">
                        <button class="btn btn-success" type="submit">Search</button>
                        <a href="<?php echo e(route('admin.newusers')); ?>">
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
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($row->id); ?></td>
                                <td><?php echo e($row->name); ?></td>
                                <td><?php echo e($row->phone); ?></td>
                               <form action="deleteusers" method="POST">
                               <?php echo csrf_field(); ?>
                                    <td class="text-center">
                                        <button class="btn btn-danger" type="submit" name="delete[<?php echo e($row->id); ?>]" value="<?php echo e($row->id); ?>" />Delete</button>
                                    </td>
                               </form> 
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>	  
                </div>
                <!-- Table End -->
    </div>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH F:\Softwar\XAMPP\htdocs\food\resources\views/admin/NewUsers/NewUsers.blade.php ENDPATH**/ ?>