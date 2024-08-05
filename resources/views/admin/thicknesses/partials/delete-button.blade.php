<!-- Modal trigger button -->
<button type="button" class="btn bg-accent" data-bs-toggle="modal" data-bs-target="#modalId-{{$thickness->id}}">
    Delete
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalId-{{$thickness->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$thickness->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId-{{$thickness->id}}">
                    Deleting Thickness
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You are about to delete this Thickness forever : {{$thickness->value}} <br>
                Are You Sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <form action="{{route('admin.thicknesses.destroy',[$catalog->slug, $thickness->value])}}" method="post">
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