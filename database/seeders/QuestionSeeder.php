<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // EI – Extroversión vs Introversión
            [
                'text' => '¿Te sientes más energizado al estar con otras personas?',
                'dimension' => 'EI',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Prefieres hablar con varias personas en vez de solo una?',
                'dimension' => 'EI',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te resulta fácil iniciar una conversación?',
                'dimension' => 'EI',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te sientes cómodo en eventos sociales grandes?',
                'dimension' => 'EI',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Prefieres estar activo y rodeado de gente durante tu tiempo libre?',
                'dimension' => 'EI',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Sueles hablar para pensar en lugar de pensar antes de hablar?',
                'dimension' => 'EI',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],

            // SN – Sensorial vs Intuitivo
            [
                'text' => '¿Prefieres hechos concretos en vez de ideas abstractas?',
                'dimension' => 'SN',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te enfocas más en lo que ocurre en el presente que en posibilidades futuras?',
                'dimension' => 'SN',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te resulta fácil recordar detalles específicos?',
                'dimension' => 'SN',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Prefieres instrucciones claras y paso a paso?',
                'dimension' => 'SN',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Tiendes a confiar más en tu experiencia directa que en tus corazonadas?',
                'dimension' => 'SN',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Sueles enfocarte en los detalles más que en el panorama general?',
                'dimension' => 'SN',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],

            // TF – Pensamiento vs Sentimiento
            [
                'text' => '¿Tomas decisiones basadas más en lógica que en emociones?',
                'dimension' => 'TF',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Prefieres ser justo antes que compasivo?',
                'dimension' => 'TF',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Sueles enfocarte más en los resultados que en cómo se sienten las personas?',
                'dimension' => 'TF',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Puedes mantener la objetividad en decisiones difíciles?',
                'dimension' => 'TF',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te incomoda mostrar tus emociones en público?',
                'dimension' => 'TF',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Sueles analizar situaciones de forma crítica más que emocional?',
                'dimension' => 'TF',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],

            // JP – Juicio vs Percepción
            [
                'text' => '¿Te gusta tener un plan establecido antes de actuar?',
                'dimension' => 'JP',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te incomoda cuando las cosas cambian inesperadamente?',
                'dimension' => 'JP',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Prefieres terminar tus tareas antes de relajarte?',
                'dimension' => 'JP',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te sientes mejor cuando tienes todo organizado?',
                'dimension' => 'JP',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te cuesta improvisar en situaciones nuevas?',
                'dimension' => 'JP',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
            [
                'text' => '¿Te gusta establecer metas y seguirlas paso a paso?',
                'dimension' => 'JP',
                'option_a' => 'Sí',
                'option_b' => 'No',
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
