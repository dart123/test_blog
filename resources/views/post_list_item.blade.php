<div class="col-6 post_item">
    <div class="row">
        <div class="col-6">
            <div class="row">
                <p class="col-12">id поста: {{$post->id}}</p>
                <a class="post_title col-12" href="/articles/{{$post->slug}}">
                    {{$post->title}}
                </a>
            </div>

            <div class="row">
                <img class="post_img col-4" src="https://via.placeholder.com/150/000000/FFFFFF/?text=Post_image"/>

                <p class="post_descr col-8">
                    {{substr($post->description, 0, 200) . ' ...'}}
                </p>
            </div>

            <div class="row">
                <p class="col-12 post_date">
                    {{$post->created_at}}
                </p>
            </div>
        </div>
        <div class="col-6">
            <div class="post_buttons">
                <a class="edit_btn" href="/articles/{{$post->id}}/edit">
                    <img src="/img/edit.svg"/>
                </a>
                <div class="delete_btn" data-post_id="{{$post->id}}" >
                    <img src="/img/delete.svg"/>
                </div>
            </div>
        </div>
    </div>
</div>
