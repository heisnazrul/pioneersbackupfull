<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('pending', 'submitted', 'reviewing', 'contacted', 'accepted', 'rejected', 'invalid') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Warning: This may truncate data if 'submitted' values exist
        DB::statement("ALTER TABLE applications MODIFY COLUMN status ENUM('pending', 'reviewing', 'contacted', 'accepted', 'rejected', 'invalid') DEFAULT 'pending'");
    }
};
