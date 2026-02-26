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
                            <div id="date-range-picker-add-label" class="d-flex items-center">
                                <div class="relative mb-3 col-6 pl-0">
                                    <label for="start_add"><b>Begin:</b></label>
                                    <input
                                    onclick="this.showPicker()"
                                    type="date"
                                    id="start_add"
                                    name="start"
                                    class="form-control"/>
                                </div>
                                <div class="relative max-w-sm col-6 pr-0">
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
                            <div>
                                <label>Bij de onderstaande staat die direct aan</label>
                            </div>
                            <div class="d-flex">
                                <div class="form-switch custom-check col-3">
                                    <label for="menu_label_toggle" class="form-label">Menu</label>
                                    <input
                                            type="checkbox"
                                            id="menu_label_toggle"
                                            name="menu_toggle"
                                            class="form-check-input ml-0">
                                </div>
                                <div class="form-switch custom-check col-3">
                                    <label for="course_label_toggle" class="form-label">Courses</label>
                                    <input
                                            type="checkbox"
                                            id="course_label_toggle"
                                            name="course_toggle"
                                            class="form-check-input ml-0">
                                </div>
                                <div class="form-switch custom-check col-3">
                                    <label for="sub_course_label_toggle" class="form-label">Sub Courses</label>
                                    <input
                                            type="checkbox"
                                            id="sub_course_label_toggle"
                                            name="sub_course_toggle"
                                            class="form-check-input ml-0">
                                </div>
                                <div class="form-switch custom-check col-3">
                                    <label for="dish_label_toggle" class="form-label">Producten</label>
                                    <input
                                            type="checkbox"
                                            id="dish_label_toggle"
                                            name="dish_toggle"
                                            class="form-check-input ml-0">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

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
