<!-- Button trigger modal -->
<button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#sideInfo{{$side_info->id}}">
    Bewerk Bijgerechten titel
</button>

<!-- Modal -->
<div class="modal fade" id="sideInfo{{$side_info->id}}" tabindex="-1" role="dialog" aria-labelledby="sideInfoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sideInfoLabel">Bijgerechten Titel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="sideInfo" action="{{route('side_info', ['id' => $side_info->id])}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="form-label">Titel</label>
                        <input name="title" id="title" value="{{$side_info->title}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title" class="form-label">Sub Titel</label>
                        <input name="sub_title" id="sub_title" value="{{$side_info->sub_title}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_en" class="form-label">Titel Engels</label>
                        <input name="title_en" id="title_en" value="{{$side_info->title_en}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title_en" class="form-label">Titel</label>
                        <input name="sub_title_en" id="sub_title_en" value="{{$side_info->sub_title_en}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_de" class="form-label">Titel Duits</label>
                        <input name="title_de" id="title_de" value="{{$side_info->title_de}}" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="sub_title_de" class="form-label">Titel</label>
                        <input name="sub_title_de" id="sub_title_de" value="{{$side_info->sub_title_de}}" type="text" class="form-control" required>
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
