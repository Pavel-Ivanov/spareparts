<?php

namespace Tests\Feature;

use App\Entities\Sparepart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SparepartManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_sparepart_can_be_added_to_the_range()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/spareparts', [
            'name' => 'Sparepart name',
            'manufacturer' => 'Renault',
        ]);

        $response->assertOk();
        $this->assertCount(1, Sparepart::all());
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/spareparts', [
            'name' => '',
            'manufacturer' => 'Renault',
        ]);

        $response->assertSessionHasErrors('name');

    }

    /** @test */
    public function a_manufacturer_is_required()
    {
        $response = $this->post('/spareparts', [
            'name' => 'Sparepart name',
            'manufacturer' => '',
        ]);

        $response->assertSessionHasErrors('manufacturer');
    }

    /** @test */
    public function a_sparepart_can_be_updated()
    {
        $this->withoutExceptionHandling();

        // Создаем запись
        $this->post('/spareparts', [
            'name' => 'Sparepart name',
            'manufacturer' => 'Manufacturer',
        ]);
        //
        $sparepart = Sparepart::first();
        //
        $response = $this->patch('/spareparts/'. $sparepart->id, [
            'name' => 'New Sparepart name',
            'manufacturer' => 'New manufacturer',
        ]);

        $this->assertEquals('New Sparepart name', Sparepart::first()->name);
        $this->assertEquals('New manufacturer', Sparepart::first()->manufacturer);

    }
}
