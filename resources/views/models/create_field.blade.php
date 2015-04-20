<div class="modal fade" id="addField" tabindex="-1" role="dialog" aria-labelledby="addFieldLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addFieldLabel">New message</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="table-id" name="field[table_id]" value="">
                    <div class="form-group">
                        <label for="field-name" class="control-label">Field Name</label>
                        <input type="text" class="form-control" id="field-name" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Field Type</label>
                        <select id="field-type" class="form-control" required>
                            <option value="">Select One...</option>
                            <option value="boolean">Boolean</option>
                            <option value="integer">Integer</option>
                            <option value="string">String (255 Characters)</option>
                            <option value="text">Text Area</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="createField()" class="btn btn-primary" data-dismiss="modal">Add Field</button>
            </div>
        </div>
    </div>
</div>