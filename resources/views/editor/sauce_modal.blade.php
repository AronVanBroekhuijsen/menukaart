<!-- Button trigger modal -->
<button type="button" class="btn btn-success col-12 add-sauce" data-toggle="modal" data-target="#addSauce">
    Saus/Topping toevoegen
</button>

<!-- Modal -->
<div class="modal fade" id="addSauce" tabindex="-1" role="dialog" aria-labelledby="addSauceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSauceLabel">Product toevoegen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form  id="addSauce" action="{{route('add_sauce')}}" method="post">
                @csrf
                <div class="modal-body row">
                    <div class="form-group">
                        <label for="title" class="form-label">Titel</label>
                        <input name="title" id="title" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_en" class="form-label">Titel Engels</label>
                        <input name="title_en" id="title_en" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title_de" class="form-label">Titel Duits</label>
                        <input name="title_de" id="title_de" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Prijs</label>
                        <input name="price" id="price" type="number" step=".01" class="form-control">
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
