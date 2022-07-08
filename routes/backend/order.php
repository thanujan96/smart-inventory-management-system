<?php

use App\Http\Controllers\Backend\OrderController;
use App\Models\Order;
use Tabuna\Breadcrumbs\Trail;

//Technical Officer Routes ----------------------------------------------------------------------------
Route::middleware(['role:Administrator|Technical Officer'])->group(function () {
    // index
    Route::get('/orders/officer', [OrderController::class, 'officer_index'])
        ->name('orders.officer.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Technical Officer'), route('admin.orders.officer.index'));;
        });

    // Show
    Route::get('/orders/officer/{approvedOrder}/view', [OrderController::class, 'officer_show'])
    ->name('orders.officer.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Technical Officer'), route('admin.orders.officer.index'))
            ->push(__('Show'));
    });

    // Confirm
    Route::get('orders/officer/{approvedOrder}/confirm/', [OrderController::class, 'officer_confirm'])
        ->name('orders.officer.confirm')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Orders'), route('admin.orders.index'))
                ->push(__('Technical Officer'), route('admin.orders.officer.index'))
                ->push(__('Confirm'));
        });

    // Ready
    Route::get('/orders/officer/{approvedOrder}/ready/', [OrderController::class, 'officer_ready'])
        ->name('orders.officer.ready');

    // Finish
    Route::post('/orders/officer/{approvedOrder}/finish', [OrderController::class, 'officer_finish'])
        ->name('orders.officer.finish');

    // Mail
    Route::put('/orders/officer/{approvedOrder}/mail/', [OrderController::class, 'officer_mail'])
    ->name('orders.officer.mail');
});


// Lecturer Order request  Routes ----------------------------------------------------------------------------
Route::middleware(['role:Administrator|Lecturer'])->group(function () {
// Technical Officer Routes ----------------------------------------------------------------------------

 // index
 Route::get('/orders/lecturer', [OrderController::class, 'lecturer_index'])
 ->name('orders.lecturer.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

 // Show
 Route::get('/orders/lecturer/{order}/view/', [OrderController::class, 'lecturer_show'])
 ->name('orders.lecturer.show')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'), route('admin.orders.lecturer.index'))
         ->push(__('Show'));
 });

     // Store the different types of updates
     Route::get('/orders/lecturer/{order}/approve/', [OrderController::class, 'lecturer_approve'])
     ->name('orders.lecturer.approve');
     Route::get('/orders/lecturer/{order}/rejected/', [OrderController::class, 'lecturer_reject'])
     ->name('orders.lecturer.rejected');

      // accepted index
 Route::get('/orders/lecturer/accepted', [OrderController::class, 'lecturer_accepted_index'])
 ->name('orders.lecturer.accepted.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

 //Rejected index
 Route::get('/orders/lecturer/rejected', [OrderController::class, 'lecturer_rejected_index'])
 ->name('orders.lecturer.rejected.index')
 ->breadcrumbs(function (Trail $trail) {
     $trail->push(__('Home'), route('admin.dashboard'))
         ->push(__('Requests'),);
 });

});


Route::get('/orders', [OrderController::class, 'index'])
->name('orders.index')
->breadcrumbs(function (Trail $trail) {
    $trail->push(__('Home'), route('admin.dashboard'))
        ->push(__('Orders'), route('admin.orders.index'));
});

// Create
Route::get('orders/create', [OrderController::class, 'create'])
    ->name('orders.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Create'));
    });


// Store
Route::post('orders', [OrderController::class, 'store'])
    ->name('orders.store');

// Show
Route::get('orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Show'));
});

// Edit
Route::get('orders/edit/{order}', [OrderController::class, 'edit'])
    ->name('orders.edit')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Edit'));
});


// Update
Route::put('orders/{order}', [OrderController::class, 'update'])
->name('orders.update');

// Delete
Route::get('orders/delete/{order}', [OrderController::class, 'delete'])
    ->name('orders.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Orders'), route('admin.orders.index'))
            ->push(__('Delete'));
});

// Destroy
Route::delete('orders/{order}', [OrderController::class, 'destroy'])
    ->name('orders.destroy');


?>