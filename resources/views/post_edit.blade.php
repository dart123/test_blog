@if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error')}}
    </div>
@elseif(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
@endif
<form id="edit_form" action="{{route('articles.update', [$post->id])}}" method="PUT">
    @csrf
    <input name="id" type="hidden" value="{{$post->id}}">
    <div class="form-group">
        <label for="title">Title</label>
        <input id="title" name="title" type="text" value="{{$post->title}}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" cols="5" rows="5">{{$post->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{$post->slug}}">
    </div>
    <input type="submit" class="btn btn-primary" value="Update">
</form>
