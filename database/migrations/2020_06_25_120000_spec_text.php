<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $parent_id = DB::table('sections')->where('alias', 'cms_params')->first()->id;
        DB::table('sections')->insert([
            [
                'alias' => 'spec_text',
                'lang_name' => 'AdminPanel::main.sections.spec_text',
                'route' => 'admin.params.specText',
                'parent_id' => $parent_id
            ],
        ]);

        Schema::create('spec_text', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias', 255)->nullable();
            $table->string('type', 255)->default('admin');
        });

        Schema::create('spec_text_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('text_id')->unsigned()->index();
            $table->string('lang', 2)->default('ru');
            $table->string('name', 255)->nullable();
            $table->string('page_title', 255)->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_key', 255)->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('text')->nullable();
        });

        Schema::table('spec_text_lang', function(Blueprint $table) {
            $table->foreign('text_id', 'spec_text_lang_1')->references('id')->on('spec_text')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        $texts = [
            [
                'alias' => 'about-cookie',
                'type' => 'admin',
                'lang' => [
                    'ru' => [
                        'name' => 'Наша политика в отношении cookie-файлов',
                        'page_title' => 'Наша политика в отношении cookie-файлов'
                    ],
                    'uk' => [
                        'name' => 'Наша політика щодо cookie-файлів',
                        'page_title' => 'Наша політика щодо cookie-файлів'
                    ]
                ]

            ],
            [
                'alias' => 'privacy-policy',
                'type' => 'admin',
                'lang' => [
                    'ru' => [
                        'name' => 'Политика конфиденциальности',
                        'page_title' => 'Политика конфиденциальности'
                    ],
                    'uk' => [
                        'name' => 'Політика конфіденційності',
                        'page_title' => 'Політика конфіденційності'
                    ]
                ]
            ],
            [
                'alias' => 'public-offer',
                'type' => 'admin',
                'lang' => [
                    'ru' => [
                        'name' => 'Договор публичной оферты',
                        'page_title' => 'Договор публичной оферты'
                    ],
                    'uk' => [
                        'name' => 'Договір публічної оферти',
                        'page_title' => 'Договір публічної оферти'
                    ]
                ]
            ],
            [
                'alias' => 'guarantee',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Гарантия',
                        'page_title' => 'Гарантия'
                    ],
                    'uk' => [
                        'name' => 'Гарантія',
                        'page_title' => 'Гарантія'
                    ]
                ]
            ],
            [
                'alias' => 'guarantee_good',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Гарантия (стр. товара)',
                        'page_title' => 'Гарантия'
                    ],
                    'uk' => [
                        'name' => 'Гарантія (стор. товару)',
                        'page_title' => 'Гарантія'
                    ]
                ]
            ],
            [
                'alias' => 'exchange',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Обмен',
                        'page_title' => 'Обмен'
                    ],
                    'uk' => [
                        'name' => 'Обмін',
                        'page_title' => 'Обмін'
                    ]
                ]
            ],
            [
                'alias' => 'exchange_good',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Обмен (стр. товара)',
                        'page_title' => 'Обмен'
                    ],
                    'uk' => [
                        'name' => 'Обмін (стор. товару)',
                        'page_title' => 'Обмін'
                    ]
                ]
            ],
            [
                'alias' => 'return',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Возврат',
                        'page_title' => 'Повернення'
                    ],
                    'uk' => [
                        'name' => 'Повернення',
                        'page_title' => 'Повернення'
                    ]
                ]
            ],
            [
                'alias' => 'return_good',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Возврат (стр. товара)',
                        'page_title' => 'Повернення'
                    ],
                    'uk' => [
                        'name' => 'Повернення (стор. товару)',
                        'page_title' => 'Повернення'
                    ]
                ]
            ],
            [
                'alias' => 'shipping',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Доставка',
                        'page_title' => 'Доставка'
                    ],
                    'uk' => [
                        'name' => 'Доставка',
                        'page_title' => 'Доставка'
                    ]
                ]
            ],
            [
                'alias' => 'shipping_good',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                    'name' => 'Доставка (стр. товара)',
                        'page_title' => 'Доставка'],
                    'uk' => [
                        'name' => 'Доставка (стор. товару)',
                        'page_title' => 'Доставка'
                    ]
                ]
            ],
            [
                'alias' => 'payment',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Оплата',
                        'page_title' => 'Оплата'],
                    'uk' => [
                        'name' => 'Оплата',
                        'page_title' => 'Оплата'
                    ]
                ]
            ],
            [
                'alias' => 'payment_good',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Оплата (стр. товара)',
                        'page_title' => 'Оплата'],
                    'uk' => [
                        'name' => 'Оплата (стор. товару)',
                        'page_title' => 'Оплата'
                    ]
                ]
            ],
            [
                'alias' => 'order-success',
                'type' => 'market',
                'lang' => [
                    'ru' => [
                        'name' => 'Заказ отправлен',
                        'page_title' => 'Заказ отправлен'
                    ],
                    'uk' => [
                        'name' => 'Замовлення відправлено',
                        'page_title' => 'Замовлення відправлено'
                    ]
                ]
            ],
            [
                'alias' => 'callback-success',
                'type' => 'admin',
                'lang' => [
                    'ru' => [
                        'name' => 'Заявка на обратный звонок отправлена',
                        'page_title' => 'Заявка на обратный звонок отправлена'
                    ],
                    'uk' => [
                        'name' => 'Заявка на зворотний дзвінок відправлена',
                        'page_title' => 'Заявка на зворотний дзвінок відправлена'
                    ]
                ]
            ],
            [
                'alias' => 'feedback-success',
                'type' => 'admin',
                'lang' => [
                    'ru' => [
                        'name' => 'Сообщение отправлено',
                        'page_title' => 'Сообщение отправлено'
                    ],
                    'uk' => [
                        'name' => 'Повідомлення відправлено',
                        'page_title' => 'Повідомлення відправлено'
                    ]
                ]
            ],
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
        DB::table('sections')->where('alias', 'spec_text')->delete();
        Schema::dropIfExists('spec_text_lang');
        Schema::dropIfExists('spec_text');
    }
}