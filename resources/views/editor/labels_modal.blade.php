<!-- Button trigger modal -->
<button type="button" class="btn btn-success col-12 add-label" data-toggle="modal" data-target="#addLabel">
    Feestdag toevoegen
</button>

<!-- Modal -->
<div class="modal fade" id="addLabel" tabindex="-1" role="dialog" aria-labelledby="addLabelLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabelLabel">Feestdag toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addLabel" action="{{route('add_label')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row">
                    <div class="col-12 row p-3">
                        <div class="form-group">
                            <label for="label-name" class="form-label"><b>Naam</b></label>
                            <input type="text" name="label-name" class="form-control" placeholder="Label Naam">
                        </div>
                        <div class="form-group">
                            <div id="date-range-picker-add-label" class="d-flex items-center">
                                <div class="relative col-6 pl-0">
                                    <label for="start_add"><b>Begin:</b></label>
                                    <input
                                    onclick="this.showPicker()"
                                    type="date"
                                    id="start_add"
                                    name="start"
                                    class="form-control"/>
                                </div>
                                <div class="relative col-6 pr-0">
                                    <label for="end_add"><b>Eind:</b></label>
                                    <input
                                    onclick="this.showPicker()"
                                    type="date"
                                    id="end_add"
                                    name="end"
                                    class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <label><b>Toepassen op</b></label>
                            <div class="d-flex">
                                @foreach($toggles as $toggle)
                                    <div class="form-switch custom-check col-3 mb-0">
                                        <label for="{{ $toggle['add_id'] }}" class="form-label">{{ $toggle['label'] }}</label>
                                        <input
                                                type="checkbox"
                                                id="{{ $toggle['add_id'] }}"
                                                name="{{ $toggle['name'] }}"
                                                class="form-check-input ml-0">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label><b>Herhaling</b></label>
                            <div class="d-flex">
                                    @foreach($repeats as $repeat)
                                        <div>
                                            <input
                                                    type="radio"
                                                    id="{{ $repeat['add_id'] }}"
                                                    name="repeat_type"
                                                    value="{{ $repeat['add_id'] }}"
                                                    class="btn-check ml-0 repeat-type"
                                                    {{ $repeat['checked'] ? 'checked' : '' }}>
                                            <label for="{{ $repeat['add_id'] }}" class="form-label btn btn-outline-primary rounded-pill me-2">{{ $repeat['label'] }}</label>
                                        </div>
                                    @endforeach
                            </div>
                            <div class="mt-2 collapse {{ $repeats[1]['checked'] ? 'show' : '' }}" id="add_days_container">
                                <label>Herhaal elke</label>
                                <div class="d-flex" id="add_repeat_days">
                                    @foreach($days as $day)
                                        <div>
                                            <input
                                                    type="checkbox"
                                                    class="btn-check repeat-day"
                                                    name="repeat_days[]"
                                                    value="{{ $day['value'] }}"
                                                    id="{{ $day['add_id'] }}" checked>
                                            <label class="btn btn-outline-primary rounded-pill me-2" for="{{ $day['add_id'] }}">{{ $day['label'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="form-label"><b>Animatie</b></label>
                            <input name="img" id="img" type="file" accept="image/gif" class="form-control">
                        </div>
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
