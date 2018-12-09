<div class="modal fade" id="uploader-modal" tabindex="-1" role="dialog" aria-labelledby="uploaderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploaderModalLabel">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-0">
        {!! Form::open([
          'route'     => 'admin.medias.store',
          'files'     => TRUE,
          'class'     => 'dropzone p-3'
        ]) !!}
          
        {!! Form::close() !!}
        <table class="file-manager file-manager-cards uploader-table d-none is-datatable table-responsive py-2 border-top border-bottom" data-ajax="{{ route('admin.datatables.medias') }}" data-columns='[{"name" : "id", "orderable" : false, "searchable" : false}, {"name" : "item", "orderable" : "false"}]' data-length-change="false" data-filter="false" data-info="false" data-paging-type="simple" data-page-length="12" data-single="{{ isset($single) ? 'true' : 'false' }}">
        </table>
      </div>
      <div class="modal-footer">
        <button id="uploader-button" class="btn btn-primary mx-auto">Insert</button>
      </div>
    </div>
  </div>
</div>