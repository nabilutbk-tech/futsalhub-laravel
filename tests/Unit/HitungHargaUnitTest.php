<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class HitungHargaUnitTest extends TestCase
{
    /**
     * Test logika perhitungan total harga sewa futsal.
     * (Misal: harga 150rb per jam, main 2 jam, harusnya 300rb).
     */
    public function test_hitung_total_harga_sewa(): void
    {
        // 1. Persiapan data (Arrange)
        $harga_per_jam = 150000;
        $durasi_jam = 2;

        // 2. Eksekusi (Act)
        $total_harga = $harga_per_jam * $durasi_jam;

        // 3. Pengecekan (Assert)
        // Kita pastikan hasilnya benar-benar 300000
        $this->assertEquals(300000, $total_harga);
    }
}