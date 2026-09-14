<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')
                ->constrained('rooms')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('student_name');
            $table->string('matric_no', 30);

            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');

            $table->string('purpose');
            $table->unsignedInteger('participants')->default(1);

            $table->enum('status', [
                'booked',
                'cancelled',
                'completed',
            ])->default('booked');

            $table->timestamps();

            $table->index([
                'room_id',
                'booking_date',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};