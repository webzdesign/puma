<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(1)->comment("0=inactive , 1=active");


            $table->string('season');
            $table->string('dumy_code');
            $table->string('final_code');
            $table->integer('style')->nullable();
            $table->string('source');//inline , non inline
            $table->string('style_desc');
            $table->string('color_desc');
            $table->string('page_RBU');
            $table->string('display_BU');
            $table->string('age_group');
            $table->string('key');
            $table->string('sort_key');//1-25 , #N/A
            $table->string('product_type');//closed shoe , slip on , slide ,mule , sandal,slipper,flip flop
            $table->integer('final_MRP');
            $table->string('final_gender');
            $table->string('Global KI')->nullable();
            $table->string('marketing_tier')->nullable();
            $table->string('channel-aw22');//comman ,offline,online,ecom
            $table->string('line');
            $table->string('customer(online)');//AJIO & Myntra ,for all online customer , not for online , Myntra,AJIO & Flipkart , Only for Myntra , Only for AJIO
            $table->string('story')->nullable();
            $table->string('colab')->nullable();
            $table->longText('upper')->nullable();
            $table->string('mid_sole')->nullable();
            $table->string('out_sole')->nullable();
            $table->longText('description')->nullable();
            $table->string('size_run');
            $table->string('technology')->nullable();
            $table->string('marketing')->nullable();
            $table->string('additional')->nullable();
            $table->string('key_highlight')->nullable();
            $table->string('fk_retail')->nullable();//yes , NULL
            $table->string('fk_discount')->nullable();
            $table->string('myntra_retail')->nullable();
            $table->string('myntra_discount')->nullable();
            $table->string('ajio_retail')->nullable();
            $table->string('ajio_discount')->nullable();
            $table->string('amazon_discount')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
