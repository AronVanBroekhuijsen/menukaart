<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changeSide{{$side->id}}">
    <i class="fa-solid fa-pencil"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="changeSide{{$side->id}}" tabindex="-1" role="dialog" aria-labelledby="changeSideLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeSideLabel">Bijgerechten toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="changeSide" action="{{route('change_side', ['id' => $side->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    @php
                        $title = $side->title($side->id);
                    @endphp
                    <div class="form-group">
                        <label for="title" class="form-label">Titel</label>
                        <input name="title" id="title" value="{{$title->nl}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_en" class="form-label">Titel Engels</label>
                        <input name="title_en" id="title_en" value="{{$title->en}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_de" class="form-label">Titel Duits</label>
                        <input name="title_de" id="title_de" value="{{$title->de}}" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
