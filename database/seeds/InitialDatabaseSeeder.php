<?php

use Illuminate\Database\Seeder;

class InitialDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// tipos de questões
        DB::table('question_types')->insert([
			[
				'id' => 1,
				'code' => 'ONE_ANSWER',
				'name' => '1 resposta',
				'description' => 'Várias opções e uma resposta.'
			],
			[
				'id' => 2,
				'code' => 'LINK',
				'name' => 'Ligar opções',
				'description' => 'Ligar as opções.'
			]
        ]);

        // questões
        DB::table('questions')->insert([
			[
				'description' => 'Em qual linguagem de programação o framework laravel fois escrito?',
				'type_id' => 1
			],
			[
				'description' => 'Ligue os seguintes textos:',
				'type_id' => 2
			]
        ]);

        // opções
        DB::table('options')->insert([
			[
				'id' => 1,
				'description' => 'Java'
			],
			[
				'id' => 2,
				'description' => 'PHP'
			],
			[
				'id' => 3,
				'description' => 'C++'
			],
			[
				'id' => 4,
				'description' => 'Servidor'
			],
			[
				'id' => 5,
				'description' => 'Apache'
			],
			[
				'id' => 6,
				'description' => 'Protocolo'
			],
			[
				'id' => 7,
				'description' => 'TCP'
			],
			[
				'id' => 8,
				'description' => 'Javascript'
			],
			[
				'id' => 9,
				'description' => 'Linguagem'
			],
        ]);

        // Questões booleanas
        DB::table('question_options_answers')->insert([
			[
				'question_id' => 1,
				'option_id' => 2
			]
		]);

        // Questões booleanas
        DB::table('question_options')->insert([
			[
				'question_id' => 1,
				'option_id' => 1
			],
			[
				'question_id' => 1,
				'option_id' => 2
			],
			[
				'question_id' => 1,
				'option_id' => 3
			]
        ]);

		// Questão de ligar
        DB::table('link_options')->insert([
			[
	        	'question_id' => 2,
	           	'option_id' => 4,
	            'link_id' => 5
	       	],
	       	[
	        	'question_id' => 2,
	           	'option_id' => 6,
	            'link_id' => 7
	       	],
	       	[
	        	'question_id' => 2,
	           	'option_id' => 8,
	            'link_id' => 9
	       	]
	    ]);
    }
}
