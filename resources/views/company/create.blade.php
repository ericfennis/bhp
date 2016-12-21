<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    Bedrijf toevoegen              </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">

                <form action="/company" method="post">

                    {{ csrf_field() }}

                    {!! \Nvd\Crud\Form::input('route_id','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('location_point','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('default_person','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('name','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('description','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('logo','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('building','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('room_number','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>
