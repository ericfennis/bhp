<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    Nieuwe faciliteit             </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">

                <form action="/facility" method="post">

                    {{ csrf_field() }}

                    <!--{!! \Nvd\Crud\Form::input('walkpath_points_id','text')->show() !!}-->
					<div class="row form-group" style='display:none;'>
						<label class="col-lg-1" for="walkpath_points_id">Walkpath Points Id</label>
						<div class="col-lg-11"><input name="walkpath_points_id" id="walkpath_points_id" class="form-control" value="0" type="text">
						</div>
					</div>

                    {!! \Nvd\Crud\Form::input('name','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('icon','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('description','text')->show() !!}

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>
