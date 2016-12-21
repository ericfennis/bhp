<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    Persoon toevoegen              </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">

                <form action="/person" method="post">

                    {{ csrf_field() }}

                    {!! \Nvd\Crud\Form::input('firstname','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('surname','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('profilepicture','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('telephone','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('email','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('website','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('status','text')->show() !!}

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>
