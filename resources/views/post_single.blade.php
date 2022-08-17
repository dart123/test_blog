@extends('base.base')

@section('title', 'Главная')

@section('content')

    @include('partials.nav_menu')

    <div class="row post_full">
        <div class="col-12">
            <input id="post_id" type="hidden" name="post_id" value="{{$post['info']->id}}">
            <div class="row">
                <h2 class="post_title col-12">
                    {{$post['info']->title}}
                </h2>
            </div>

            <div class="row">
                <div class="col-6">
                    <img class="post_img" src="https://via.placeholder.com/300/000000/FFFFFF/?text=Post_image">
                </div>
                <div class="col-6"></div>

                <p class="post_descr col-12">
                    {{$post['info']->description}}
                </p>

            </div>

            <hr/>

            <div class="row">
                <div class="col-12">
                    <h2>Комментарии:</h2>
                    @foreach($post['comments'] as $comment)
                        <div class="comment_item" data-comment_id="{{$comment->id}}">
                            <p class="comment_user">{{$comment->user->name}}</p>
                            <p class="comment_text">{{$comment->content}}</p>
                            <button class="btn-primary reply_btn">Reply</button>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>

            <hr/>

            <div class="row">
                <div class="col-12">
                    <h2>Отправить комментарий</h2>
                    <p>Replying to:</p>
                    <p class="reply_to_text"></p>
                    <form class="row" id="comment_form" action="/api/add_comment" enctype="multipart/form-data" method="post" name="comment">
                        <input type="hidden" name="post_id" value="{{$post['info']->id}}">
                        <input type="hidden" name="parent_id" value="">
                        <label class="col-12" for="comment">Комментарий</label>
                        <textarea class="col-12" id="comment" name="content" rows="5" required></textarea>

                        <button type="submit" class="btn btn-secondary submit_btn">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
