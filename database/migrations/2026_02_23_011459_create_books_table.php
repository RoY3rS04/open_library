<?php

use App\Enums\BookStatus;
use App\Models\Author;
use App\Models\Category;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'submitted_by')->constrained();
            $table->foreignIdFor(User::class, 'approved_by')->nullable()->constrained();
            $table->string('title');
            $table->enum('status', BookStatus::cases());
            $table->string('isbn')->index()->unique()->nullable();
            $table->string('edition');
            $table->date('release_date');
            $table->integer('pages');
            $table->string('pdf_path');
            $table->text('synopsis');
            $table->string('publisher');
            $table->string('language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('category_book');
        Schema::dropIfExists('books');
    }
};
