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
        DB::statement("CREATE VIEW `nib_jateng_view` AS with counts as (select coalesce(`cjipnew`.`proyeks`.`uraian_skala_usaha`,'kosong') AS `skala_usaha`,`cjipnew`.`proyeks`.`nib` AS `nib`,count(0) AS `count` from (`cjipnew`.`proyeks` left join (select `cjipnew`.`nibs`.`id` AS `id`,`cjipnew`.`nibs`.`day_of_tanggal_terbit_oss` AS `day_of_tanggal_terbit_oss` from `cjipnew`.`nibs`) `nibs` on(`cjipnew`.`proyeks`.`nib_id` = `nibs`.`id`)) group by `cjipnew`.`proyeks`.`uraian_skala_usaha`)select `counts`.`skala_usaha` AS `skala_usaha`,coalesce(sum(`counts`.`count`),0) AS `count` from `counts` group by `counts`.`skala_usaha`");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `nib_jateng_view`");
    }
};
