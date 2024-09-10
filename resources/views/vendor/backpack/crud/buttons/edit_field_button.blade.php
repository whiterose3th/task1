@if (isset($crud) && $crud->hasAccess('update'))
    <a href="javascript:void(0)" class="btn btn-sm btn-link edit-field-button" data-entry-id="{{ $entry->getKey() }}">
        <i class="la la-edit"></i> Edit
    </a>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-field-button').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const entryId = this.getAttribute('data-entry-id');
                const fieldToEdit = this.closest('.form-group').querySelector('input, textarea');
                if (fieldToEdit) {
                    fieldToEdit.removeAttribute('readonly');
                    fieldToEdit.focus();
                }
            });
        });
    });
</script>
