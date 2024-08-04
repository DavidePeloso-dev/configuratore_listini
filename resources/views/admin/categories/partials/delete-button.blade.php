<!-- Modal trigger button -->
<button type="button" class="btn bg-accent" data-bs-toggle="modal" data-bs-target="#modalId-{{$category->id}}">
    Delete
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId-{{$category->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$category->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId-{{$category->id}}">
                    Deleting Category
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You are about to delete this Category forever : {{$category->name}} <br>
                Are You Sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <form action="{{route('admin.categories.destroy',[$catalog->slug, $category->slug])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-accent">
                        Delete
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>