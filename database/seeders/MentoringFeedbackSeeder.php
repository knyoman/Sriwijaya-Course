<?php

namespace Database\Seeders;

use App\Models\MentoringFeedback;
use App\Models\Mentoring;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentoringFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelajars = User::where('peran', 'pelajar')->get();
        $mentorings = Mentoring::all();

        if ($mentorings->count() > 0 && $pelajars->count() > 0) {
            $feedbackTexts = [
                'Penjelasan sangat detail dan mudah dipahami',
                'Mentor sangat membantu dan responsif terhadap pertanyaan',
                'Materi dikemas dengan baik dan relevan dengan kebutuhan',
                'Sesi mentoring sangat bermanfaat untuk pengembangan skill',
                'Terima kasih telah membimbing dengan sabar dan detail',
                'Feedback yang diberikan sangat membantu untuk improvement',
                'Metode mengajar interaktif dan engaging',
                'Dapat mempelajari best practice langsung dari mentor berpengalaman',
            ];

            // Create multiple feedbacks for each mentoring
            foreach ($mentorings as $mentoring) {
                // Add 3-5 feedbacks per mentoring session
                $feedbackCount = rand(3, 5);
                for ($i = 0; $i < $feedbackCount; $i++) {
                    if ($pelajars->count() > $i) {
                        MentoringFeedback::create([
                            'mentoring_id' => $mentoring->id,
                            'pelajar_id' => $pelajars->get($i)->id,
                            'rating' => rand(3, 5),
                            'feedback_text' => $feedbackTexts[array_rand($feedbackTexts)],
                            'benefits' => json_encode(['skill_improvement' => true, 'knowledge_gained' => true]),
                        ]);
                    }
                }
            }

            echo "Mentoring Feedback seeder completed successfully!\n";
        }
    }
}
