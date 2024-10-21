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
                <button href="#" wire:click.prevent="new" data-bs-toggle="modal" data-bs-target="#QuizModel"
                        class="btn btn-primary rounded-pill float-end">
                    <i class="fas fa-plus-circle fa-lg"></i> <b>New</b>
                </button>
            </div>
        </div>
    </div>




{{--    <div class="d-flex justify-content-end">
        <a wire:click.prevent="new" href="#" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#QuizModel">
            <i class="fas fa-plus-circle fa-lg"></i> <b>New</b>
        </a>
    </div>--}}

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr style="text-transform: capitalize;vertical-align: middle;" class="text-center">
                    <th scope="col">#</th>
                    <th style="text-align: left;" scope="col">Title</th>
                    <th style="text-align: left;" scope="col">Description</th>
                    <th scope="col">Count Question</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $QuizItem)
                    <tr style="text-transform: capitalize;vertical-align: middle;" class="text-center">
                        <th scope="row">{{$QuizItem->id}}</th>
                        <td style="text-align: left;">{{substr($QuizItem->title,0,25)}}</td>
                        <td style="text-align: left;">{{substr($QuizItem->description,0,60)}}</td>
                        <td>{{$QuizItem->question_count}}</td>
                        <td>
                            <div class=" form-switch">
                                <input wire:click="changeStatus({{$QuizItem->id}})"
                                       class="form-check-input align-middle" type="checkbox"
                                       id="flexSwitchCheckChecked" {{$QuizItem->status==1 ? 'checked' : ''}}>
                            </div>

                        </td>
                        <td>
                            <a href="{{ route('ques',[$QuizItem->slug,$QuizItem->id]) }}" class="btn btn-outline-secondary rounded-pill">
                                <i class="fas fa-question text-primary"></i>
                            </a>

                            <a wire:click.prevent="EditQuiz({{$QuizItem->id}})" class="btn btn-outline-secondary rounded-pill"  data-bs-toggle="modal" data-bs-target="#QuizModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                            <a wire:click.prevent="DeleteQuiz({{$QuizItem->id}})" class="btn btn-outline-secondary rounded-pill" href="#"><i class="bi bi-trash-fill text-danger"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-danger text-center"><h5>Not found data </h5></td></tr>
                @endforelse


                </tbody>
            </table>
            <div class="pagination justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>



    <!-- Button trigger modal -->
    <div wire:ignore.self class="modal fade" id="QuizModel" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-body mt-1">
                    <form>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input wire:model="title" type="text" class="form-control" id="title">
                                <span>@error('title') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="level" class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <select  wire:model="level" class="form-select" id="level">
                                    <option value="">Select Level</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <span>@error('level') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea wire:model="description" class="form-control" rows="3" id="description">

                                </textarea>

                                <span>@error('description') <p class="text-danger">{{$message}} @enderror</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    @if($editMode == true)
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button wire:click="UpdateQuiz" type="button" class="btn btn-primary rounded-pill">Update</button>
                    @else
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                        <button wire:click="SaveQuiz" type="button" class="btn btn-primary rounded-pill">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized',()=>{
        @this.on('close-quiz',(event)=>{
            //alert('product created/updated')
            var myModalEl=document.querySelector('#QuizModel')
            var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

            setTimeout(() => {
                modal.hide();
            @this.dispatch('reset-modal');
            }, 1000);
        })

        var mymodal=document.getElementById('QuizModel')
        mymodal.addEventListener('hidden.bs.modal',(event)=>{
        @this.dispatch('reset-modal');
        })
    })
</script>
