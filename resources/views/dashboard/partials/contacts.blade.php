<div class="col-2 m-t-10 ">
        @forelse($contacts as $contact)
        <div class="card m-t-5">
                <div class="card-body">
                <p class="text-muted">{{$contact->name}}</p>
                </div>
              </div>
        @empty
        You have no contacts;
        @endforelse
    </div>