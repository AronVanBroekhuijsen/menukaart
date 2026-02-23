            <form  id="changeLabel_{{$label->id}}" action="{{route('change_label', ['id' => $label->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12 row p-3">
                        <div class="form-group">
                            <label for="label-name" class="form-label">Naam</label>
                            <input type="text" name="label-name" class="form-control" placeholder="Label Naam" value="{{$label->name}}">
                        </div>
                        <div class="form-group">
                            <div id="date-range-picker-change-label" class="flex items-center">
                                <div class="relative">
                                    <label for="start_change"><b>Begin:</b></label>
                                    <input
                                    type="date"
                                    id="start_change"
                                    name="start"
                                    class="form-control"
                                    max="{{$label->end}}"
                                    value="{{$label->start}}"/>
                                </div>
                                <div class="relative max-w-sm">
                                    <label for="end_change"><b>Eind:</b></label>
                                    <input
                                    type="date"
                                    id="end_change"
                                    name="end"
                                    class="form-control"
                                    min="{{$label->start}}"
                                    value="{{$label->end}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="form-label">Animatie</label>
                            <input name="img" id="img" type="file" accept="image/gif" class="form-control">
                            @if ($label->image)
                                <img src="{{ asset('storage/images/uploaded/'. $label->image) }}" class="bg-secondary" width="200px">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

