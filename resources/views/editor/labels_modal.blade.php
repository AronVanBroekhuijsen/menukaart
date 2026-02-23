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
                            <label for="label-name" class="form-label">Naam</label>
                            <input type="text" name="label-name" class="form-control" placeholder="Label Naam">
                        </div>
                        <div class="form-group">
                            <div id="date-range-picker-add-label" class="flex items-center">
                                <div class="relative">
                                    <label for="start_add"><b>Begin:</b></label>
                                    <input
                                    type="date"
                                    id="start_add"
                                    name="start"
                                    class="form-control"/>
                                </div>
                                <div class="relative max-w-sm pl-2">
                                    <label for="end_add"><b>Eind:</b></label>
                                    <input
                                    type="date"
                                    id="end_add"
                                    name="end"
                                    class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img" class="form-label">Animatie</label>
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
