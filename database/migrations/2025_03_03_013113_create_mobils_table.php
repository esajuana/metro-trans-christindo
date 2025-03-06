<?php

use App\Models\User;
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
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('nopolisi')->nullable();
            $table->string('merk')->nullable();
            $table->enum('kategori', ['DENGAN_KUNCI', 'TANPA_KUNCI'])->nullable();
            $table->integer('kapasitas')->nullable();
            $table->integer('harga')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
        
    }
};
