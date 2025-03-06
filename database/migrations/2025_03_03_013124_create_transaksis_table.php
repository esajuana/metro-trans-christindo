<?php

use App\Models\Mobil;
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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Mobil::class);
            $table->string('nama')->nullable();
            $table->string('ponsel')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('alamat')->nullable();
            $table->string('alamat_pengiriman')->nullable();
            $table->string('nama_kantor')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->string('nomor_telp_kantor')->nullable();
            $table->string('nomor_lain')->nullable();
            $table->text('tujuan_sewa')->nullable();
            $table->datetime('waktu_mulai')->nullable();
            $table->datetime('waktu_selesai')->nullable();
            $table->datetime('waktu_pengembalian')->nullable();
            $table->decimal('total_pembayaran', 15, 2)->nullable();
            $table->decimal('dp', 15, 2)->nullable();
            $table->decimal('sisa_pembayaran', 15, 2)->nullable();
            $table->enum('status_pembayaran', ['BELUM_LUNAS', 'LUNAS'])->default('BELUM_LUNAS');
            $table->string('metode_pembayaran')->nullable();
            $table->enum('status_transaksi', ['PENDING', 'DIPROSES', 'SELESAI', 'DIBATALKAN'])->default('PENDING');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
