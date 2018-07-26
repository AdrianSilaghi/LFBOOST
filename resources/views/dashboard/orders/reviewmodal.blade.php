
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Review & Mark as Complete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="{{ route('addReview',[$boost->id]) }}">
                            {{ csrf_field() }}
                    
                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Comment</label>
                    
                                
                                <textarea class="form-control" name="comment" id="commentArea" rows="3"></textarea>
                    
                                    @if ($errors->has('comment'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                
                            </div>
                            <input type="hidden" value={{$boost->id}} id="post_id" name="post_id">
                            <input type="hidden" value={{$order->transaction_id}} id="transaction_id" name="transaction_id">
                            <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                    <label for="example" class="col-md-4 control-label">Raiting</label>

                                    <select id="example" name="raiting" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                    </select>
                            
                                <input type="hidden" name="post_id" value="{{$boost->id}}">            
                                        
                            </div>
                            <div class="form-group">
                                <button id="markasComplete" class="btn btn-outline-success" type="button">Mark as complete</button>
                            </div>
                    </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
    </div>
</div>