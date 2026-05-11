<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite không hỗ trợ ALTER COLUMN trực tiếp, dùng raw SQL để thay đổi enum
        // Với SQLite, cột enum thực chất là TEXT với constraint, nên chỉ cần cập nhật CHECK constraint
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE class_user MODIFY COLUMN role ENUM('teacher', 'student', 'assistant') NOT NULL");
        }
        // SQLite lưu enum như TEXT nên không cần migrate, giá trị 'assistant' đã được chấp nhận
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql' || $driver === 'mariadb') {
            DB::statement("ALTER TABLE class_user MODIFY COLUMN role ENUM('teacher', 'student') NOT NULL");
        }
    }
};
