<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Question extends Component
{

    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $editMode = false;
    public $quiz_id, $selected_id,$search,$count=10;


    public $image,$currentImage, $question, $optionA, $optionB, $optionC, $optionD, $correct_answer, $class, $level;

    public function rules()
    {
        return [
            'question' => 'required|string|max:255',
            'optionA' => 'max:255',
            'optionB' => 'max:255',
            'optionC' => 'max:255',
            'optionD' => 'max:255',
            'correct_answer' => 'required|string',
            'class' => 'required|string',
            'level' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,bmp|max:10972',

        ];
    }


    public function mount($quiz_id)
    {
        $this->quiz_id = $quiz_id;
    }

    public function render()
    {
        if (!$this->search)
        {
            $data = \App\Models\Question::where('quiz_id', $this->quiz_id)->orderBy('id', 'DESC')->simplePaginate($this->count);

        }else{
            $data = \App\Models\Question::where('quiz_id', $this->quiz_id)
                ->whereAny(['question','optionA','optionB','optionC','optionD','correct_answer','class','level'],'like','%'.$this->search.'%')
                ->orderBy('id', 'DESC')
                ->simplePaginate($this->count);

        }

        return view('livewire.admin.question', compact('data'));

    }


    public function SaveQuestion()
    {
        $this->validate();

        // Məlumatı saxla
        $create = \App\Models\Question::create([
            'quiz_id' => $this->quiz_id,
            'question' => $this->question,
            'image' => $this->image ? $this->image->store('question', 'public') : null,
            'optionA' => $this->optionA,
            'optionB' => $this->optionB,
            'optionC' => $this->optionC,
            'optionD' => $this->optionD,
            'correct_answer' => $this->correct_answer,
            'class' => $this->class,
            'level' => $this->level
        ]);

        if ($create) {
            toastr()->closeButton(true)->title($create->question)->success($create->question . ' Added Successfully.');
        } else {
            toastr()->closeButton(true)->error($create->question . ' Failed to Add.');
        }

        // Modalı bağlamaq üçün dispatch istifadə et
        $this->dispatch('close-modal');

        // Formu sıfırla
        $this->reset('question', 'image','currentImage', 'optionA', 'optionB', 'optionC', 'optionD', 'correct_answer', 'class', 'level');
    }


    public function EditQuestion($id)
    {
        if ($id) {
            $this->editMode = true;
            $edit = \App\Models\Question::find($id);
            $this->image = null; // Fayl sahəsi fayl obyekti ilə işləmir

            // Əgər mövcud şəkili göstərmək istəyirsənsə, bunu ayrıca img tag ilə göstər
            $this->currentImage = Storage::url($edit->image);
            $this->question = $edit->question;
            $this->optionA = $edit->optionA;
            $this->optionB = $edit->optionB;
            $this->optionC = $edit->optionC;
            $this->optionD = $edit->optionD;
            $this->correct_answer = $edit->correct_answer;
            $this->class = $edit->class;
            $this->level = $edit->level;
            $this->selected_id = $edit->id;
        } else {
            toastr()->error('Question not found.');
        }
    }

    public function UpdateQuestion()
    {
        $this->validate();
      //  dd($this->validate());

       // dd($this->image);

        // dd($this->question, $this->image, $this->optionA, $this->optionB, $this->optionC, $this->optionD, $this->correct_answer, $this->class, $this->level);

        $data = \App\Models\Question::findOrFail($this->selected_id);
        $photo = $data->image;
        if ($this->image && is_object($this->image)) {
            Storage::delete('public/' . $data->image);
            $photo = $this->image->store('question', 'public');
        } else {
            $photo = $data->image;
        }

        $update = $data->update(
            [
                'question' => $this->question,
                'image' => $photo,
                'optionA' => $this->optionA,
                'optionB' => $this->optionB,
                'optionC' => $this->optionC,
                'optionD' => $this->optionD,
                'correct_answer' => $this->correct_answer,
                'class' => $this->class,
                'level' => $this->level
            ]);

        if ($update) {
            toastr()->closeButton(true)->title($data->question)->success($data->question . ' Updated Successfully.');
        } else {
            toastr()->closeButton(true)->error($data->question . ' Failed to Add.');
        }

        // Modalı bağlamaq üçün dispatch istifadə et
        $this->dispatch('close-modal');

        // Formu sıfırla
        $this->reset('question', 'image','currentImage', 'optionA', 'optionB', 'optionC', 'optionD', 'correct_answer', 'class', 'level');
    }

    public function DeleteQuestion($id)
    {
        $data = \App\Models\Question::findOrFail($id);
        Storage::delete('public/' . $data->image);
        $data->delete();
        if ($data) {
            toastr()->closeButton(true)->title($data->question)->success($data->question . '  Deleted.');
        } else {
            toastr()->closeButton(true)->error($data->question . ' Failed to Delete.');
        }
    }


    public function new()
    {
        $this->reset('question','currentImage', 'image', 'optionA', 'optionB', 'optionC', 'optionD', 'correct_answer', 'class', 'level');
        $this->editMode = false;
    }

    public function changeStatus($id)
    {
        $status = \App\Models\Question::where('id', $id)->first();

        if ($status->status == 1) {
            $status->status = 0;
        } else {
            $status->status = 1;
        }
        $status->save();
    }

    public function removeImage()
    {
        if ($this->image) {
            $this->image = null; // Seçilmiş şəkili sıfırla
        } elseif ($this->currentImage) {
            $data = \App\Models\Question::findOrFail($this->selected_id);
            Storage::delete('public/' . $data->image);

            // Bazadan şəkili sildikdən sonra currentImage-i də sıfırla ki, modalda da görünməsin
            $this->currentImage = null;

            // Eyni zamanda bazada şəkil məlumatını boşalt
            $data->image = null;
            $data->save();
        }
    }


}
