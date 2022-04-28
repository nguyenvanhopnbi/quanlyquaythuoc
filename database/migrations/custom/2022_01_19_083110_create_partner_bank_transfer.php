<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerBankTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_bank_transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('partner_code', 30);
            $table->string('bank_account_name', 50);
            $table->string('bank_account_no', 100);
            $table->string('bank_account_type');
            $table->string('bank_code', 30);
            $table->string('bank_branch', 100);
            $table->string('bbds_id', 30);
            $table->string('content', 250);
            $table->integer('amount');
            $table->enum('status', ['pending', 'success', 'error']);
            $table->integer('status_code')->nullable();
            $table->string('status_message')->nullable();
            $table->string('partner_ref_id')->nullable();
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
//        Schema::dropIfExists('partner_bank_transfer');
    }
}
