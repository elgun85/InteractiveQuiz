<div>

    <div class="card-title">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto "style="margin-right: -70px;" >
                <input wire:model.live="search" type="search" class="form-control">
            </div>
            <div class="col-auto">
                <select wire:model.live="count" class="form-select">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-8">
                <button href="#" wire:click.prevent="new" data-bs-toggle="modal" data-bs-target="#QuestionModel"
                        class="btn btn-primary rounded-pill float-end">
                    <i class="fas fa-plus-circle fa-lg"></i> <b>New</b>
                </button>
            </div>
        </div>
    </div>



    {{--    <div class="d-flex justify-content-between">
            <div class="col-auto">
                <input wire:model.live="search" type="search" class="form-control">
            </div>
            <div class="col-auto">
                <select wire:model.live="count" class="form-select">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-8 ">
            <a wire:click.prevent="new" href="#" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#QuestionModel">
                <i class="fas fa-plus-circle fa-lg"></i> <b>New</b>
            </a>
            </div>
        </div>--}}

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr style="text-transform: capitalize;" class="text-center">
                    <th scope="col" style="text-align: left;">#</th>
                    <th scope="col" style="text-align: left;">Question</th>
                    <th scope="col">Image</th>
                    <th scope="col">option A</th>
                    <th scope="col">option B</th>
                    <th scope="col">option C</th>
                    <th scope="col">option D</th>
                    <th scope="col">Correct</th>
                    <th scope="col">Class</th>
                    <th scope="col">Level</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $QuestionItem)
                    <tr style="text-transform: capitalize;vertical-align: middle;" class="text-center" >
                        <th scope="row" style="text-align: left;">{{$QuestionItem->id}}</th>
                        <td style="text-align: left;">{{substr($QuestionItem->question,0,26)}}</td>
                        <td>
                            @if(!empty($QuestionItem->image) && file_exists(storage_path('app/public/'.$QuestionItem->image)))
                                <img
                                    src="{{ asset('storage/'.$QuestionItem->image) }}"
                                    alt=""
                                    style="width: 50px; height: 50px"
                                    class="rounded-circle"
                                />
                            @else
                                <span>no foto</span>
                            @endif


                        </td>
                        <td>{{substr($QuestionItem->optionA,0,15)}}</td>
                        <td>{{substr($QuestionItem->optionB,0,15)}}</td>
                        <td>{{substr($QuestionItem->optionC,0,15)}}</td>
                        <td>{{substr($QuestionItem->optionD,0,15)}}</td>
                        <td>
                            @switch($QuestionItem->correct_answer)
                                @case('optionA')
                                    <span class="text-success">Option A </span>
                                    @break

                                @case('optionB')
                                    <span class="text-success">Option B</span>
                                    @break

                                @case('optionC')
                                    <span class="text-success">Option C</span>
                                    @break
                                @case('optionD')
                                    <span class="text-success">Option D</span>
                                    @break
                                @case('optionE')
                                    <span class="text-success">Option E</span>
                                    @break

                                @default
                                    <span class="text-muted">Unknown</span>
                            @endswitch
                        </td>
                        <td>{{$QuestionItem->class}}</td>
                        <td>{{$QuestionItem->level}}</td>
                        <td>
                            <div class=" form-switch">
                                <input wire:click="changeStatus({{$QuestionItem->id}})"
                                       class="form-check-input align-middle" type="checkbox"
                                       id="flexSwitchCheckChecked" {{$QuestionItem->status==1 ? 'checked' : ''}}>
                            </div>

                        </td>
                        <td style="text-align: center;">
                            <a wire:click.prevent="EditQuestion({{$QuestionItem->id}})" class="btn btn-outline-secondary rounded-pill"  data-bs-toggle="modal" data-bs-target="#QuestionModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                            <a wire:click.prevent="DeleteQuestion({{$QuestionItem->id}})" class="btn btn-outline-secondary rounded-pill" href="#"><i class="bi bi-trash-fill text-danger"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="12" class="text-danger text-center"><h5>Not found data </h5></td></tr>
                @endforelse


                </tbody>
            </table>
            <div class="pagination justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>



    <!-- Button trigger modal -->
    <div wire:ignore.self class="modal fade" id="QuestionModel" tabindex="-1">
        <div class="modal-dialog modal-lg">


                <div class="modal-content">
                    <div class="modal-body">
                    </div>
                    <div class="modal-body mt-1">
                        <form enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label mt-3">Image</label>
                                <div class="col-sm-10">
                                    {{-- Fayl yüklənərkən yükləmə ikonu --}}
                                    <div wire:loading wire:target="image">
                                        <img src="/path/to/loading-icon.gif" alt="Loading..." width="50" height="50" />
                                    </div>

                                    {{-- Əgər fayl seçilibsə, müvəqqəti URL ilə göstər və silmə düyməsi əlavə et --}}
                                    @if ($image instanceof \Illuminate\Http\UploadedFile && $image->temporaryUrl() != null)
                                        <div style="position: relative; display: inline-block;">
                                            <img width="100" height="100" class="rounded mb-3" src="{{ $image->temporaryUrl() }}" />
                                            <button type="button" wire:click="removeImage" style="position: absolute; top: 0; right: 0; background-color: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer;">
                                                &times;
                                            </button>
                                        </div>
                                        {{-- Əgər mövcud şəkil varsa və yeni fayl seçilməyibsə --}}
                                    @elseif (is_string($currentImage) && (!str_contains($currentImage, '/storage/') || str_contains($currentImage, '/storage/question/')))
                                        <div style="position: relative; display: inline-block;">
                                            <img id="preview" src="{{ $currentImage }}" width="100px" height="100px" class="rounded mb-3"/>
                                            <button type="button" wire:click="removeImage" style="position: absolute; top: 0; right: 0; background-color: red; color: white; border: none; border-radius: 50%; width: 20px; height: 20px; cursor: pointer;">
                                                &times;
                                            </button>
                                        </div>
                                    @endif

                                    {{-- Fayl yükləmə sahəsi --}}
                                    <input id="image" type="file" wire:model="image" class="form-control mt-3">
                                    <span>@error('image') <p class="text-danger">{{$message}} @enderror</span>
                                </div>



{{--                                                                <div class="col-sm-10">
                                    <div wire:loading wire:target="image">
                                        <img src="/path/to/loading-icon.gif" alt="Loading..." width="50" height="50" />
                                    </div>

                                    @if ($image instanceof \Illuminate\Http\UploadedFile && $image->temporaryUrl() != null)
                                        <img width="100" height="100" class="rounded mb-3" src="{{ $image->temporaryUrl() }}" />
                                    @elseif (is_string($currentImage) && (!str_contains($currentImage, '/storage/') || str_contains($currentImage, '/storage/question/')))
                                        <img id="preview" src="{{ $currentImage }}" width="100px" height="100px" class="rounded mb-3"/>
                                    @endif

                                    <input id="image" type="file" wire:model="image" class="form-control mt-3">
                                    <span>@error('image') <p class="text-danger">{{$message}} @enderror</span>
                                </div>--}}



                            </div>

                            <div class="row mb-3">
                                <label style="text-transform: capitalize;" for="question" class="col-sm-2 col-form-label">Question</label>
                                <div class="col-sm-10">
                                <textarea wire:model="question" class="form-control" rows="1" id="question">
                                </textarea>
                                    <span>@error('question') <p class="text-danger">{{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label style="text-transform: capitalize;" for="optionA" class="col-sm-2 col-form-label">Option A</label>
                                <div class="col-sm-10">
                                    <input wire:model="optionA" type="text" class="form-control" rows="1" id="optionA">
                                    <span>@error('optionA') <p class="text-danger">{{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label style="text-transform: capitalize;" for="optionB" class="col-sm-2 col-form-label">Option B</label>
                                <div class="col-sm-10">
                                    <input wire:model="optionB" type="text" class="form-control" rows="1" id="optionB">
                                    <span>@error('optionB') <p class="text-danger">{{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label style="text-transform: capitalize;" for="optionC" class="col-sm-2 col-form-label">Option C</label>
                                <div class="col-sm-10">
                                    <input wire:model="optionC" type="text" class="form-control" rows="1" id="optionC">
                                    <span>@error('optionC') <p class="text-danger">{{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label style="text-transform: capitalize;" for="optionD" class="col-sm-2 col-form-label">Option D</label>
                                <div class="col-sm-10">
                                    <input wire:model="optionD" type="text" class="form-control" rows="1" id="optionD">
                                    <span>@error('optionD') <p class="text-danger">{{$message}} @enderror</span>
                                </div>
                            </div>

                            <div class="row mb-3">

                                <label for="correct_answer" class="col-sm-2 col-form-label" style="text-transform: capitalize;">Correct</label>
                                <div class="col-sm-3">
                                    <select wire:model="correct_answer" class="form-select" id="correct_answer">
                                        <option value="">Select Option</option>
                                        <option value="optionA">Option A</option>
                                        <option value="optionB">Option B</option>
                                        <option value="optionC">Option C</option>
                                        <option value="optionD">Option D</option>
                                    </select>
                                    <span>@error('correct_answer') <p class="text-danger">{{$message}}</p> @enderror</span>
                                </div>


                                <label for="class" class="col-sm-1 col-form-label" style="text-transform: capitalize;">Class</label>
                                <div class="col-sm-2">
                                    <select wire:model="class" class="form-select" id="class">
                                        <option value="">Select Class</option>
                                        <option value="class1">Class 1</option>
                                        <option value="class2">Class 2</option>
                                        <option value="class3">Class 3</option>
                                        <option value="class4">Class 4</option>
                                    </select>
                                    <span>@error('class') <p class="text-danger">{{$message}}</p> @enderror</span>
                                </div>

                                <label for="level" class="col-sm-1 col-form-label" style="text-transform: capitalize;">Level</label>
                                <div class="col-sm-3">
                                    <select wire:model="level" class="form-select" id="level">
                                        <option value="">Select Level</option>
                                        <option value="easy">Easy</option>
                                        <option value="medium">Medium</option>

                                        <option value="hard">Hard</option>
                                    </select>
                                    <span>@error('level') <p class="text-danger">{{$message}}</p> @enderror</span>
                                </div>


                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        @if($editMode == true)
                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                            <button wire:click="UpdateQuestion" type="button" class="btn btn-primary rounded-pill">Update</button>
                        @else
                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                            <button wire:click="SaveQuestion" type="button" class="btn btn-primary rounded-pill">Save</button>
                        @endif
                    </div>
                </div>
        </div>
    </div>






</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('close-modal', () => {
            var myModalEl = document.getElementById('QuestionModel');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            if (!modal) {
                modal = new bootstrap.Modal(myModalEl);
            }
            modal.hide();
        });
    });

</script>


