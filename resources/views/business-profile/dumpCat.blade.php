@foreach($childs as $child)
    <option value="{{ $child->id }}">{{ $child->name }}</option>
@endforeach