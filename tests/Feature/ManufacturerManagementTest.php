<?php

namespace Tests\Feature;

use App\Entities\Manufacturer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManufacturerManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_manufacturer_can_be_created()
    {
        $this->withoutExceptionHandling();

        $this->post('/manufacturers', [
            'name' => 'Имя производителя',
            'country' => 'Россия',
            'dob' => '07.10.1961',
        ]);

        $manufacturer = Manufacturer::all();
        $this->assertCount(1, $manufacturer);
        $this->assertInstanceOf(Carbon::class, $manufacturer->first()->dob);
        $this->assertEquals('07.10.1961', $manufacturer->first()->dob->format('d.m.Y'));
    }
}
