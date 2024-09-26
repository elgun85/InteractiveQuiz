<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    #[Rule('required|min:3')]
    public $title;
    #[Rule('required|min:3|max:250')]
    public $description;
    public $selected_id;

    public $editMode=false;

    public function render()
    {
        $data=\App\Models\Category::paginate(5);
        return view('livewire.admin.category',compact('data'));
    }

    public function SaveCategory()
    {
        $this->validate();
        $create = \App\Models\Category::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
        ]);

        $this->dispatch('close-category');

        if ($create) {
            toastr()->closeButton(true)->title($create->title)->success('Category Added Successfully.');
        } else {

            toastr()->closeButton(true)->error('Category Failed to Add.');
        }
        $this->reset('title','description');
    }

    public function EditCategory($id)
    {
        if ($id) {
            $this->editMode = true;
            $edit = \App\Models\Category::find($id);

            if ($edit) {
                $this->title = $edit->title;
                $this->description = $edit->description;
                $this->selected_id = $edit->id;
            } else {
                $this->editMode = false;
                toastr()->closeButton(true)->error('Category not found.');
            }
        }

    }
    public function UpdateCategory()
    {
        $this->validate();
        try {
            $category = \App\Models\Category::findOrFail($this->selected_id);
            $update = $category->update([
                'title' => $this->title,
                'description' => $this->description,
                'slug' => Str::slug($this->title)
            ]);
            $this->dispatch('close-category');
            if ($update) {

                toastr()->closeButton(true)->title($category->title)->success('Category Update Successfully.');
            } else {
                toastr()->closeButton(true)->error('Category Failed to Update.');
            }
            $this->reset('title','description');
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Category not found.');
        }

    }

    public function DeleteCategory($id)
    {

        try {
            $category = \App\Models\Category::findOrFail($id);
            $delete = $category->delete();
            $this->dispatch('close-category');

            if ($delete) {
                toastr()->closeButton(true)->title($category->title)->success('Category Delete Successfully.');
            } else {
                toastr()->closeButton(true)->error('Category Failed to Delete.');
            }
        } catch (\Exception $e) {
            toastr()->closeButton(true)->error('Category not found.');
        }
    }


    public function new()
    {
        $this->reset('title','description');
        $this->editMode=false;
    }

    public function changeStatus($id)
    {
        $status=\App\Models\Category::where('id',$id)->first();

        if ($status->status == 1)
        {
            $status->status =0;
        }else{
            $status->status=1;
        }
        $status->save();
    }
}
