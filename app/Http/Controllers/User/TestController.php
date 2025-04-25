<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function show(\App\Models\TestSet $test_set)
    {
        $test_set->load('questions.choices'); // 問題＋選択肢も読み込む
        return view('user.tests.show', compact('test_set'));
    }

    public function submit(Request $request, \App\Models\TestSet $test_set)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|integer',
        ]);

        $test_set->load('questions.choices');

        $correctCount = 0;

        foreach ($test_set->questions as $question) {
            $selectedChoiceId = $request->input("answers.{$question->id}");

            $correctChoice = $question->choices->firstWhere('is_correct', true);

            if ($correctChoice && $selectedChoiceId == $correctChoice->id) {
                $correctCount++;
            }
        }

        $total = $test_set->questions->count();
        $scorePercent = round(($correctCount / $total) * 100);

        $isPass = $scorePercent >= 80;

        return view('user.tests.result', compact('correctCount', 'total', 'scorePercent', 'isPass'));
    }

}
