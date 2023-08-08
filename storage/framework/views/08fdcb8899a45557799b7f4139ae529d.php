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
      <td class="text-center"><a href="<?php echo e(route('admin.newusers')); ?>" class="btn btn-primary">
      View  
    </a>
      </td>
    </tr>
    <tr>
      <th scope="row" class="text-center">2</th>
      <td>Update Food List</td>
      <td class="text-center"><a href="<?php echo e(route('admin.foodlist')); ?>" class="btn btn-success">View </a> 
      </td>
    </tr>
  </tbody>
</table>
</div>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3)): ?>
<?php $component = $__componentOriginal91fdd17964e43374ae18c674f95cdaa3; ?>
<?php unset($__componentOriginal91fdd17964e43374ae18c674f95cdaa3); ?>
<?php endif; ?>
<?php /**PATH F:\Softwar\XAMPP\htdocs\food\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>