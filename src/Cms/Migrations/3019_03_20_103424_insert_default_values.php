<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InsertDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $zeus_admin_custom_field_groups = [
            [
                'id' => 1,
                'name' => 'SEO',
                'slug' => 'seo',
                'description' => 'Блок для настройки SEO',
                'position' => 'left',
                'order' => '99.99'
            ]
        ];

        $zeus_admin_custom_field_group_conditions = [
            [
                'group_id' => 1,
                'condition_type' => 'in',
                'condition_parameter' => 'post_type',
                'condition_value' => 'page'
            ],
            [
                'group_id' => 1,
                'condition_type' => 'in',
                'condition_parameter' => 'post_type',
                'condition_value' => 'post'
            ]
        ];

        $zeus_admin_custom_fields = [
            [
                'name' => 'SEO Заголовок',
                'slug' => 'seo-title',
                'type' => 'input',
                'group_id' => 1,
                'description' => 'Отвечает за вывод meta заголовка (title)',
                'value' => null,
                'html' => null,
                'options' => null,
                'required' => false,
                'order' => '101.1',
            ],
            [
                'name' => 'SEO Описание',
                'slug' => 'seo-description',
                'type' => 'input',
                'group_id' => 1,
                'description' => 'Отвечает за вывод meta описание (description)',
                'value' => null,
                'html' => null,
                'options' => null,
                'required' => false,
                'order' => '101.2',
            ],
            [
                'name' => 'SEO Ключевые Слова',
                'slug' => 'seo-keywords',
                'type' => 'input',
                'group_id' => 1,
                'description' => 'Отвечает за вывод meta ключевых слов (keywords). Вводятся через запятую.',
                'value' => null,
                'html' => null,
                'options' => null,
                'required' => false,
                'order' => '101.3',
            ],
        ];

        DB::table('zeus_admin_custom_field_groups')->insert($zeus_admin_custom_field_groups);
        DB::table('zeus_admin_custom_field_group_conditions')->insert($zeus_admin_custom_field_group_conditions);
        DB::table('zeus_admin_custom_fields')->insert($zeus_admin_custom_fields);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
