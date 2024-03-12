@foreach($options as $option)
    @if ($loop->first)
        <option value="{{$option->size}}" selected="selected">{{$option->size}}</option>
    @else
        <option value="{{$option->size}}">{{$option->size}}</option>
    @endif
@endforeach
