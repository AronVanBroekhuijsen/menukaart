            <form  id="changeLabel_{{$label->id}}" action="{{route('change_label', ['id' => $label->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12 row p-3">
                        <div class="form-group">
                            <label for="label-name" class="form-label"><b>Naam</b></label>
                            <input type="text" name="label-name" class="form-control" placeholder="Label Naam" value="{{$label->name}}">
                        </div>
                        <div class="form-group">
                            <div id="date-range-picker-change-label" class="d-flex items-center">
                                <div class="relative col-6 pl-0">
                                    <label for="start_change"><b>Begin:</b></label>
                                    <input
                                    onfocus="this.showPicker()"
                                    type="date"
                                    id="start_change"
                                    name="start"
                                    class="form-control"
                                    max="{{$label->end}}"
                                    value="{{$label->start}}"/>
                                </div>
                                <div class="relative max-w-sm col-6 pr-0">
                                    <label for="end_change"><b>Eind:</b></label>
                                    <input
                                    onfocus="this.showPicker()"
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
                            <label><b>Herhaling</b></label>
                            <div class="d-flex">
                                @foreach($repeats as $repeat)
                                    <div>
                                        <input
                                                type="radio"
                                                id="{{ $repeat['change_id'] }}"
                                                name="repeat_type"
                                                value="{{ $repeat['change_id'] }}"
                                                class="btn-check ml-0 repeat-type"
                                                {{ $repeat['checked'] ? 'checked' : '' }}>
                                        <label for="{{ $repeat['change_id'] }}" class="form-label btn btn-outline-primary rounded-pill me-2">{{ $repeat['label'] }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-2 collapse" {{ $repeats[1]['checked'] ? 'show' : '' }} id="change_days_container">
                                <label>Herhaal elke</label>
                                <div class="d-flex" id="change_repeat_days">
                                    @foreach($days as $day)
                                        <div>
                                            <input
                                                    type="checkbox"
                                                    class="btn-check repeat-day"
                                                    name="repeat_days[]"
                                                    value="{{ $day['value'] }}"
                                                    id="{{ $day['change_id'] }}"
                                                    {{ $day['selected'] ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary rounded-pill me-2" for="{{ $day['change_id'] }}">{{ $day['label'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="form-switch custom-check col-1 mb-0">
                                    <label for="change_labeltype"><b>Toevoeging</b></label>
                                    <input
                                            type="checkbox"
                                            id="change_labeltype"
                                            name="additions_type"
                                            class="form-check-input m-0"
                                            {{ $labeltype ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="form-label"><b>Animatie</b></label>
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

