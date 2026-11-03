<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::redirect('/', '/items/create');

Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

Route::post('/item', [ItemController::class, 'store'])->name('item.store');
