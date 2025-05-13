<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Psychologist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychologistsTableSeeder extends Seeder
{
    public function run()
    {
        $psychologists = [
            [
                'user' => [
                    'name' => 'Dra. Ana López',
                    'email' => 'analopez@psicologia.test',
                    'password' => Hash::make('password123'),
                    'role' => 'psychologist'
                ],
                'profile' => [
                    'name' => 'Dra. Ana López',
                    'photo_url' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400',
                    'specialty' => 'Ansiedad y estrés',
                    'approach' => 'Terapia cognitivo-conductual',
                    'experience' => 12,
                    'languages' => 'Español, Inglés',
                    'age' => 42,
                    'studies' => 'Licenciatura en Psicología (UNAM), Maestría en Terapia Cognitiva (Universidad de Barcelona)',
                    'bio' => 'Especializada en trastornos de ansiedad en adultos. Enfoque práctico con técnicas basadas en evidencia científica.'
                ]
            ],
            [
                'user' => [
                    'name' => 'Dr. Carlos Méndez',
                    'email' => 'carlosmendez@psicologia.test',
                    'password' => Hash::make('password123'),
                    'role' => 'psychologist'
                ],
                'profile' => [
                    'name' => 'Dr. Carlos Méndez',
                    'photo_url' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400',
                    'specialty' => 'Terapia de pareja',
                    'approach' => 'Terapia sistémica',
                    'experience' => 8,
                    'languages' => 'Español, Francés',
                    'age' => 38,
                    'studies' => 'Licenciatura en Psicología (UDG), Especialidad en Terapia Familiar',
                    'bio' => 'Experto en resolver conflictos de pareja y mejorar la comunicación emocional.'
                ]
            ],
            [
                'user' => [
                    'name' => 'Dra. Sofía Ramírez',
                    'email' => 'sofiaramirez@psicologia.test',
                    'password' => Hash::make('password123'),
                    'role' => 'psychologist'
                ],
                'profile' => [
                    'name' => 'Dra. Sofía Ramírez',
                    'photo_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400',
                    'specialty' => 'Psicología infantil',
                    'approach' => 'Terapia de juego',
                    'experience' => 15,
                    'languages' => 'Español',
                    'age' => 45,
                    'studies' => 'Especialidad en Psicología Infantil (Hospital Infantil de México)',
                    'bio' => 'Especialista en desarrollo infantil y problemas de aprendizaje con enfoque lúdico.'
                ]
            ],
            [
                'user' => [
                    'name' => 'Dr. Javier Torres',
                    'email' => 'javier@psicologia.test',
                    'password' => Hash::make('password123'),
                    'role' => 'psychologist'
                ],
                'profile' => [
                    'name' => 'Dr. Javier Torres',
                    'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400',
                    'specialty' => 'Depresión',
                    'approach' => 'Terapia humanista',
                    'experience' => 10,
                    'languages' => 'Español, Portugués',
                    'age' => 39,
                    'studies' => 'Maestría en Psicoterapia Humanista',
                    'bio' => 'Acompaño procesos de autodescubrimiento y crecimiento personal en casos de depresión.'
                ]
            ],
            [
                'user' => [
                    'name' => 'Dra. Mariana Sánchez',
                    'email' => 'mariana@psicologia.test',
                    'password' => Hash::make('password123'),
                    'role' => 'psychologist'
                ],
                'profile' => [
                    'name' => 'Dra. Mariana Sánchez',
                    'photo_url' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400',
                    'specialty' => 'Trauma y PTSD',
                    'approach' => 'EMDR y terapia somática',
                    'experience' => 7,
                    'languages' => 'Español, Inglés, Alemán',
                    'age' => 35,
                    'studies' => 'Certificación en EMDR por el Instituto EMDR México',
                    'bio' => 'Especialista en trauma complejo y estrés postraumático con métodos innovadores basados en neurociencia.'
                ]
            ]
        ];

        foreach ($psychologists as $psy) {
            $user = User::firstOrCreate(
                ['email' => $psy['user']['email']],
                $psy['user']
            );

            Psychologist::firstOrCreate(
                ['user_id' => $user->id],
                $psy['profile']
            );
        }
    }
}