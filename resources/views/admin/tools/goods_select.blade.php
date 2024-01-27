<div class="btn-group" data-toggle="buttons">
    @foreach($goods as $id => $name)
        <label class="btn btn-default {{ request()->get('goods') == $id ? 'active' : '' }}">
            <input type="radio" class="user-gender" value="{{ $id }}">{{$name}}
        </label>
    @endforeach
</div>
