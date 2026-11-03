<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_inventory_form_saves_items_and_uses_local_css(): void
    {
        $this->get('/')
            ->assertRedirect('/items/create');

        $this->get('/items/create')
            ->assertOk()
            ->assertSee('css/inventory.css')
            ->assertSee('Tambah barang');

        $this->post('/item', [
            'code' => 'INV-TEST-001',
            'item_name' => 'Laptop',
            'category' => 'Elektronik',
            'stock' => 2,
            'condition' => 'baik',
            'room_location' => 'Ruang IT',
        ])->assertRedirect('/items/create')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('items', [
            'code' => 'INV-TEST-001',
            'item_name' => 'Laptop',
            'stock' => 2,
        ]);

        $this->get('/items/create')
            ->assertOk()
            ->assertSee('INV-TEST-001')
            ->assertSee('Laptop');
    }
}
