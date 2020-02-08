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
        $response = $this->post('/spareparts', [
            'name' => 'Sparepart name',
            'manufacturer' => 'Renault',
        ]);

        $sparepart = Sparepart::first();

        $this->assertCount(1, Sparepart::all());
        $response->assertRedirect($sparepart->path());
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
        // Создаем запись
        $this->post('/spareparts', [
            'name' => 'Sparepart name',
            'manufacturer' => 'Manufacturer',
        ]);
        // Получаем созданную запись из БД
        $sparepart = Sparepart::first();
        // Изменяем созданную запись и получаем результат
        $response = $this->patch($sparepart->path(), [
            'name' => 'New Sparepart name',
            'manufacturer' => 'New manufacturer',
        ]);

        $this->assertEquals('New Sparepart name', Sparepart::first()->name);
        $this->assertEquals('New manufacturer', Sparepart::first()->manufacturer);

        $response->assertRedirect($sparepart->fresh()->path());
    }

    /** @test */
    public function a_sparepart_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        // Создаем запись
        $this->post('/spareparts', [
            'name' => 'Sparepart name',
            'manufacturer' => 'Manufacturer',
        ]);
        // Получаем созданную запись из БД
        $sparepart = Sparepart::first();
        // Проверяем наличие 1 записи в БД
        $this->assertCount(1, Sparepart::all());
        // Удаляем созданную запись
        $response = $this->delete($sparepart->path());
        // Проверяем отстутствие записей в БД
        $this->assertCount(0, Sparepart::all());
        // Проверяем редирект на index
        $response->assertRedirect('/spareparts');
    }
}
