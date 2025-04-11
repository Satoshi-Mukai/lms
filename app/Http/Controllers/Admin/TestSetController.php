<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestSet;
use App\Models\Question;
use App\Models\Choice;

class TestSetController extends Controller
{

    public function index()
    {
        $testSets = TestSet::withCount('questions')->latest()->get();
        return view('admin.test_sets.index', compact('testSets'));
    }

    public function edit($id)
    {
        $testSet = TestSet::with('questions')->findOrFail($id);
        return view('admin.test_sets.edit', compact('testSet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'year' => 'required|string',
        ]);

        $testSets = TestSet::findOrFail($id);
        $testSets->update($request->only(['name', 'year']));

        return redirect()->route('admin.test_sets.index')->with('success', 'テスト情報を更新しました。');
    }


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
            'questions.*.choices' => 'required|array|min:3',
            'questions.*.choices.*' => 'required|string',
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

        return redirect()->route('admin.test_sets.index')->with('success', 'テストセットを登録しました');
    }
}