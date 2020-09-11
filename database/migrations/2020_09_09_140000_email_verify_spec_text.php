<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailVerifySpecText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        $texts = [
            [
                'alias' => 'email-verify',
                'type' => 'admin',
                'lang' => [
                    'ru' => [
                        'name' => 'Email подтвержден',
                        'page_title' => 'Email подтвержден'
                    ],
                    'uk' => [
                        'name' => 'Email підтверджено',
                        'page_title' => 'Email підтверджено'
                    ]
                ]

            ]
        ];

        $langs = DB::table('languages')->where('hidden_admin', 0)->get()->pluck('code')->toArray();

        foreach ($texts as $text) {
            DB::table('spec_text')->insert(['alias' => $text['alias'], 'type' => $text['type']]);
            $text_id = DB::table('spec_text')->max('id');
            foreach ($langs as $lang) {
                if ($lang == 'ru' || $lang == 'uk') {
                    DB::table('spec_text_lang')->insert(['lang' => $lang, 'text_id' => $text_id, 'name' => $text['lang'][$lang]['name'], 'page_title' => $text['lang'][$lang]['page_title'], 'meta_title' => $text['lang'][$lang]['page_title']]);
                } else {
                    DB::table('spec_text_lang')->insert(['lang' => $lang, 'text_id' => $text_id, 'name' => '', 'page_title' => '', 'meta_title' => '']);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('spec_text')->where('alias', 'email-verify')->delete();
    }
}