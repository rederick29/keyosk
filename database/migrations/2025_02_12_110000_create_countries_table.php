<?php

use App\Utils\CountryCodes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2)->unique();
            $table->timestamps();
        });

        // alter table add constraint check does not work on sqlite
        if (DB::connection()->getDriverName() != 'sqlite') {
            DB::statement("ALTER TABLE countries ADD CONSTRAINT chk_country_code_valid CHECK (code IN ('" . implode('\', \'', array_keys(CountryCodes::get_codes())) . "'))");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
