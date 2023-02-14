<?php

use App\Models\WardrobeItemDraft;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('wardrobe_item_drafts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('image');
            $table->string('status')->default(WardrobeItemDraft::STATUS_DRAFT);
            $table->string('sex');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('wardrobe_item_drafts');
    }
};
