<?php
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
        // Schema::create('packs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title', 255);
        //     $table->text('description');
        //     $table->unsignedBigInteger('image_id')->nullable();
        //     $table->timestamps();

        //     $table->foreign('image_id')->references('id')->on('images');
        // });

        // Perform INNER JOIN in a query to get the related image data
        $query = "
            SELECT packs.*, images.*
            FROM packs
            INNER JOIN images ON packs.id = images.id_pack
        ";

        $results = DB::select($query);

        foreach ($results as $result) {
            // Process the obtained data as needed
            $packId = $result->id;
            $packTitle = $result->title;
            $packDescription = $result->description;
            $imageColumn = $result->image_column;

            // Perform any desired actions with the retrieved data
            // For example, you can create new records, update existing ones, etc.
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
