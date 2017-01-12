<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    Nieuwe route                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">

                <form action="/walkpath" method="post">

                    {{ csrf_field() }}

                    {!! \Nvd\Crud\Form::input('name','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('description','text')->show() !!}

					<!--{!! \Nvd\Crud\Form::input('status','text')->show() !!}-->
					<div class="row form-group">
						<label class="col-lg-1" for="status">Status</label>
						<div class="col-lg-11">
							<select name="status" id="status" class="form-control" value="" type="text">
								<option value="0">Inactief</option>
								<option value="1">Actief</option>
							</select>
						</div>
					</div>

					<!-- deze maar even verstoppen.. -->
					<input id="status" name="status" value="0" disabled="disabled" style="display:none;" />

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>
