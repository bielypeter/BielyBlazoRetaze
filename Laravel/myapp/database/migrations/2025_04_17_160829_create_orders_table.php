
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null');
            $table->integer('total_price');
            $table->enum('delivery_method', ['address', 'personal collection']);
            $table->enum('payment_method', ['card', 'cash', 'apple pay']);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
