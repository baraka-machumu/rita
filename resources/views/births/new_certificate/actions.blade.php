<div class="row top-margin-tab">

    <div class="col-md-6">

        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Actions</td>
            </tr>

            </tbody>
        </table>


        @if($processing)

            <form method="post" action="{{url('birth-certificates/new/approve',$trackerId)}}">

                {{csrf_field()}}

                <button class="btn btn-success" type="submit">Approve</button>
                <a href="#" class="btn btn-info">Reject</a>



                <div class="form-group">
                    <label>Comment</label>
                    <textarea rows="2" name="comments" class="form-control"></textarea>

                </div>
            </form>

        @elseif($verify)

            <form method="post" action="{{url('birth-certificates/new/verify',$trackerId)}}">

                {{csrf_field()}}

                <button class="btn btn-success" type="submit">Accept</button>
                <a href="#" class="btn btn-info">Return</a>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea rows="2" name="comments" class="form-control"></textarea>

                </div>
            </form>

        @endif

        @if($issue)

            <form method="post" action="{{url('birth-certificates/new/issue',$trackerId)}}">

                {{csrf_field()}}

                <button class="btn btn-success" type="submit">Issue and Print</button>
                <a href="#" class="btn btn-info">Return</a>
                <div class="form-group">
                    <label>Comment</label>
                    <textarea rows="2" name="comments" class="form-control"></textarea>

                </div>
            </form>
        @endif



    </div>

    <div class="col-md-6">


        <table class="table table-striped">

            <tbody>

            <tr style="background-color: #0E6BB7; color: white;">
                <td colspan="12">Comments</td>
            </tr>

            </tbody>
        </table>

        <div>

            @foreach($comments as $comment)

                <ul class="list-unstyled timeline">
                    <li>
                        <div class="block">
                            <div class="tags">
                                <a href="" class="tag">
                                    <span>{{$comment->CommentType}}</span>
                                </a>
                            </div>
                            <div class="block_content">
                                <h2 class="title">
                                    <a>{{$comment->Comment}}</a>
                                </h2>
                                <div class="byline">
                                    <span>{{$comment->Date}}</span> by <a>{{$comment->Username}}</a>
                                </div>

                            </div>
                        </div>
                    </li>
                    <li>
                    </li>
                </ul>

            @endforeach
        </div>

    </div>

</div>
