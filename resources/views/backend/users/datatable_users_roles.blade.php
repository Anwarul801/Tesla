@if(!empty($user->getRoleNames()))
    @foreach($user->getRoleNames() as $v)
        <label class="badge badge-success">{{ $v }}</label>
    @endforeach
@endif
