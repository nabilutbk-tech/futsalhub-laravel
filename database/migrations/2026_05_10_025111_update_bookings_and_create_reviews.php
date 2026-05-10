<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Tambah kolom ke tabel bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->text('addons')->nullable(); // Simpan JSON: ["Bola", "Sepatu"]
            $table->string('coupon_code')->nullable();
            $table->decimal('total_price', 12, 2)->after('status');
        });

        // Buat tabel reviews
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('field_id')->constrained()->onDelete('cascade');
            $table->integer('rating'); // 1-5
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
