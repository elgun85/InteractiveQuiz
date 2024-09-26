<div>
    <div class="d-flex justify-content-end">
        <a wire:click.prevent="new" href="#" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#CategoryModel">
            <i class="fas fa-plus-circle fa-lg"></i> <b>New</b>
        </a>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($data as $categoryItem)
                    <tr>
                        <th scope="row">{{$categoryItem->id}}</th>
                        <td>{{\Illuminate\Support\Str::limit($categoryItem->title,25)}}</td>
                        <td>{{\Illuminate\Support\Str::limit($categoryItem->description,60)}}</td>
                        <td>
                            <div class=" form-switch">
                                <input wire:click="changeStatus({{$categoryItem->id}})"
                                       class="form-check-input align-middle" type="checkbox"
                                       id="flexSwitchCheckChecked" {{$categoryItem->status==1 ? 'checked' : ''}}>
                            </div>

                        </td>
                        <td>
                            <a wire:click.prevent="Quiz({{$categoryItem->id}})" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#CategoryModel" href="#"><i class="fas fa-question text-primary"></i></a>
                            <a wire:click.prevent="EditCategory({{$categoryItem->id}})" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#CategoryModel" href="#"><i class="bi bi-pencil-fill text-primary"></i></a>
                            <a wire:click.prevent="DeleteCategory({{$categoryItem->id}})" class="btn btn-outline-secondary" href="#"><i class="bi bi-trash-fill text-danger"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-danger text-center"><h5>Not found data </h5></td></tr>
                @endforelse


                </tbody>
            </table>
            <div class="pagination justify-content-center">
                {{ $data->links() }}
                {{--  {{ $data->links('vendor.custom-pagination') }}--}}


            </div>
        </div>
    </div>



    <!-- Button trigger modal -->
    <div wire:ignore.self class="modal fade" id="CategoryModel" tabindex="-1">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="UpdateCategory" type="button" class="btn btn-primary">Update</button>
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:click="SaveCategory" type="button" class="btn btn-primary">Save</button>
                    @endif
                </div>
            </div>
        </div>
    </div>



</div>
<script>
    document.addEventListener('livewire:initialized',()=>{
        @this.on('close-category',(event)=>{
            //alert('product created/updated')
            var myModalEl=document.querySelector('#CategoryModel')
            var modal=bootstrap.Modal.getOrCreateInstance(myModalEl)

            setTimeout(() => {
                modal.hide();
            @this.dispatch('reset-modal');
            }, 1000);
        })

        var mymodal=document.getElementById('CategoryModel')
        mymodal.addEventListener('hidden.bs.modal',(event)=>{
        @this.dispatch('reset-modal');
        })
    })
</script>
