<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSet;
use App\Models\Question;
use App\Models\Choice;

class TestSetController extends Controller
{
    public function create()
    {
        return view('admin.test_sets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|max:4',
            'name' => 'nullable|string|max:255',
            'questions.*.title' => 'required|string',
            'questions.*.choices.*.text' => 'required|string',
            'questions.*.correct_choice' => 'required|integer|min:0|max:2',
        ]);

        // テストセットを作成
        $testSet = TestSet::create([
            'year' => $request->year,
            'name' => $request->name,
        ]);

        // 各質問と選択肢を保存
        foreach ($request->questions as $questionData) {
            $question = $testSet->questions()->create([
                'title' => $questionData['title'],
            ]);

            foreach ($questionData['choices'] as $index => $choiceText) {
                $question->choices()->create([
                    'text' => $choiceText,
                    'is_correct' => ($index == $questionData['correct_choice']),
                ]);
            }
        }

        return redirect()->route('admin.test_sets.create')->with('success', 'テストセットを登録しました');
    }
}