<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    Persoon toevoegen                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">

                <form action="/person" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    {!! \Nvd\Crud\Form::input('firstname','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('surname','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('profilepicture','file')->show() !!}

                    {!! \Nvd\Crud\Form::input('telephone','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('email','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('website','text')->show() !!}

					<div class="row form-group">
						<label class="col-lg-1" for="status">Bedrijf</label>
						<div class="col-lg-11">
							<select name="company_id" id="company_id" class="form-control" value="" type="text">
								@forelse ( $companies as $company )
									<option value="{{ $company->id }}">{{$company->name}}</option>
								@empty
									<option value="0" disabled>Geen bedrijven gevonden</option>
								@endforelse
							</select>
						</div>
					</div>

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

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>
