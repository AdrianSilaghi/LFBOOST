
<!-- Modal -->
<div class="modal fade" id="deliverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Deliver Order</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                   <small class="form-text text-muted">Before you can deliver your order you must provide proof of service completion.
                       <hr>
                       Please attach at least 2 screenshots.(They might be in the progrees of the service or after it).
                       <hr>
                   </small>
                   {{-- push agian --}}
                   <div class="d-flex">
                        <div class="col" id="uploadForm">
                        <form action="{{url('api/addImage')}}" class="dropzone">
                        {{ csrf_field() }}
                        </form>
                           
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
    </div>
</div>