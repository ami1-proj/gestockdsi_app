<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $tableName = 'affectations';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('objet',100)->comment('objet de l affectation');

            $table->dateTime('date_debut')->comment('marque le debut de l affectation');
            $table->dateTime('date_fin')->nullable()->comment('marque de la fin de l affectation');

            $table->unsignedBigInteger('type_affectation_id')->nullable()->comment('reference du type d affectation');
            $table->foreign('type_affectation_id')->references('id')->on('type_affectations')->onDelete('set null');

            $table->unsignedBigInteger('departement_id')->nullable()->comment('reference du departement');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('set null');

            $table->unsignedBigInteger('employe_id')->nullable()->comment('reference du stock');
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('stock_id')->nullable()->comment('reference du stock');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'affectations d articles'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affectations', function (Blueprint $table) {
          $table->dropForeign(['statut_id']);
          $table->dropForeign(['type_affectation_id']);
          $table->dropForeign(['departement_id']);
          $table->dropForeign(['employe_id']);
          $table->dropForeign(['stock_id']);
        });
        Schema::dropIfExists('affectations');
    }
}
