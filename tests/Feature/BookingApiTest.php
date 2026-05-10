<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_conflict_returns_409()
    {
        $user = User::factory()->create();
        
        $field = Field::create([
            'name' => 'Lapangan A',
            'price_per_hour' => 100000
        ]);

        // 1. Format tanggal existing ke string standar SQL
        $existingStartTime = now()->addDays(1)->setTime(10, 0, 0)->format('Y-m-d H:i:s');
        $existingEndTime = now()->addDays(1)->setTime(12, 0, 0)->format('Y-m-d H:i:s');

        Booking::create([
            'user_id' => $user->id,
            'field_id' => $field->id,
            'start_time' => $existingStartTime,
            'end_time' => $existingEndTime,
            'status' => 'confirmed'
        ]);

        // 2. Format tanggal JSON Payload ke string standar SQL
        $newStartTime = now()->addDays(1)->setTime(11, 0, 0)->format('Y-m-d H:i:s');
        $newEndTime = now()->addDays(1)->setTime(13, 0, 0)->format('Y-m-d H:i:s');

        // 3. Tambahkan 'sanctum' agar API mengenali user yang sedang login
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/bookings', [
            'field_id' => $field->id,
            'start_time' => $newStartTime,
            'end_time' => $newEndTime,
        ]);

        // 4. Pastikan sistem menolak dengan status 409 (Conflict)
        $response->assertStatus(409);
        $response->assertJson(['message' => 'Jadwal bentrok dengan pemesanan lain.']);
    }
}