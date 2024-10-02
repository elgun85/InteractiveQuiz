<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;
use Livewire\WithPagination;


class Quiz extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $editMode=false;

    public $categoryId;
    public $slug;
    #[Rule('required|min:3')]
    public $title;
    #[Rule('required|min:3|max:250')]
    public $description;
    #[Rule('required')]
    public $level;
    public $selected_id;

    public function mount($id)
    {
        $this->categoryId = $id;
    }

    public function render()
    {
       $data=\App\Models\Quiz::where('category_id',$this->categoryId)
           ->orderBy('id','DESC')
           ->paginate(5);

        return view('livewire.admin.quiz',compact('data'));
    }

    public function SaveQuiz()
    {
        $this->validate();
        $create = \App\Models\Quiz::create([
            'title' => $this->title,
            'category_id' => $this->categoryId,
            'slug' => Str::slug($this->title),
            'level' => $this->level,
            'description' => $this->description,
        ]);

        $this->dispatch('close-quiz');

        if ($create) {
            toastr()->closeButton(true)->title($create->title)->success('Quiz Added Successfully.');
        } else {

            toastr()->closeButton(true)->error('Quiz Failed to Add.');
        }
        $this->reset('title','description','level');
    }

    public function EditQuiz($id)
    {
        if ($id) {
            $this->editMode = true;
            $edit = \App\Models\Quiz::find($id);

            if ($edit) {
                $this->title = $edit->title;
                $this->level = $edit->level;
                $this->description = $edit->description;
                $this->selected_id = $edit->id;
            } else {
                $this->editMode = false;
                toastr()->closeButton(true)->error('Quiz not found.');
            }
        }

    }
    public function UpdateQuiz()
    {
        $this->validate();
        try {
            $Quiz = \App\Models\Quiz::findOrFail($this->selected_id);
            $update = $Quiz->update([
                'title' => $this->title,
                'description' => $this->description,
                'slug' => Str::slug($this->title)
            ]);
            $this->dispatch('close-quiz');
            if ($update) {

                toastr()->closeButton(true)->title($Quiz->title)->success('Quiz Update Successfully.');
            } else {
                toastr()->closeButton(true)->error('Quiz Failed to Update.');
            }
            $this->reset('title','description','level');
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Quiz not found.');
        }

    }

    public function DeleteQuiz($id)
    {

        try {
            $Quiz = \App\Models\Quiz::findOrFail($id);
            $delete = $Quiz->delete();
            $this->dispatch('close-quiz');

            if ($delete) {
                toastr()->closeButton(true)->title($Quiz->title)->success('Quiz Delete Successfully.');
            } else {
                toastr()->closeButton(true)->error('Quiz Failed to Delete.');
            }
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Quiz not found.');
        }
    }




    public function new()
    {
        $this->reset('title','description','level');
        $this->editMode=false;
    }

    public function changeStatus($id)
    {
        $status=\App\Models\Quiz::where('id',$id)->first();

        if ($status->status == 1)
        {
            $status->status =0;
        }else{
            $status->status=1;
        }
        $status->save();
    }
}
