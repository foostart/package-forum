<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Foostart\Category\Helpers\FoostartMigration;

class CreateForumTable extends FoostartMigration
{
    public function __construct()
    {
        $this->table = 'forum_questions';
        $this->prefix_column = 'forum_question_';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists($this->table);
        Schema::create($this->table, function (Blueprint $table) {

            $table->increments($this->prefix_column . 'id')->comment('Primary key');

            // Relation
            $table->integer('category_id')->nullable()->comment('Category ID');

            // Other attributes
            $table->string($this->prefix_column . 'name', 255)->comment('Post name');
            $table->integer($this->prefix_column . 'order')->nullable()->comment('Order in list of categories');
            $table->string($this->prefix_column . 'slug', 1000)->comment('Slug in URL');
            $table->string($this->prefix_column . 'overview', 1000)->comment('Post overview');
            $table->text($this->prefix_column . 'description')->comment('Post description');
            $table->string($this->prefix_column . 'image', 255)->nullable()->comment('Image path');
            $table->string($this->prefix_column . 'files', 1000)->nullable()->comment('The list of attachment filenames');

            //Set common columns
            $this->setCommonColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
