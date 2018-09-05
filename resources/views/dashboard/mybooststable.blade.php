
@inject('order','App\Order')

<table class="table" id="myBoostsTable">
<thead>
    <tr>
    <th scope="col">Boost Title</th>
    <th scope="col">Status</th>
        <th scope="col">Moderator Comment</th>
    <th scope="col">Clicks</th>
    <th scope="col">Views</th>
    <th scope="col">Orders</th>
    <th scope="col"> </th>
    </tr>
</thead>

<tbody>
        <tr class="">
    @foreach($posts as $post)
    @php
    $name = $post->title;
    $clicks = $post->getViews();
    $views = $post->getUniqueViews();
    $orders = $order->where('post_id',$post->id)->count();
    $user = auth()->user();
    @endphp
        <td id="{{$post->id}}">
                <a href="{{route('showWithName',[$post->user->name,$post->slug])}}">                                                            
                    {{{$name}}}
                </a>
            
        
        </td>
        <td>
            @if($post->verified == true)
            <button class="btn btn-success btn-sm" disabled>Approved</button>
                @else
                <button class="btn btn-warning btn-sm" disabled>Pending Approval</button>
                    @endif
            @if($post->denied == true)
                    <button class="btn btn-danger btn-sm" disabled>Needs Modification</button>
                @endif
        </td>
            <td>{{$post->modification}}</td>
        <td>{{$clicks}}</td>
        <td>{{$views}}</td>
        <td>{{$orders}}</td>
        <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                <a role="button" href="{{route('editBoost',['id'=>$post->id,'userId'=>auth()->user()->id])}}" class="btn btn-info btn-sm text-white">Edit</a>
                <button type="button" class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-sm">Delete</button>
                </div>
                <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                            <div class="modal-body justify-content-center">
                                <h5 class="text-center mt-2 mb-2">Are you sure?</h5>
                            <a role="button" href="{{route('destroy',['id'=>$post->id])}}" class="btn btn-success">Yes</a>
                                    <button class="btn btn-warning float-right"  class="close" data-dismiss="modal" aria-label="Close">No</button>   
                            </div>
                    </div>
                  </div>
                </div>
               
        </td>
        </tr>
    @endforeach
</tbody>
</table>
