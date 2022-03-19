<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<div class="box box-success box-12">
		<div class="box-header with-border">
		  <h3 class="box-title">Document Upload</h3>
		   <h3 class="create-project-msg"></h3>
	
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form class="form-horizontal" method="post" action="{{route('employee.upload.document')}}" enctype="multipart/form-data">
			{{ csrf_field() }}
		  <div class="box-body">
	
		   
			<div class="form-group col-sm-10 col-sm-offset-1 has-feedback{{ $errors->has('description') ? ' has-error' : '' }}">
			  <label for="description" class="col-sm-3 control-label">Description</label>
			  <div class="col-sm-9">
				<textarea name="description" class="form-control custom-class " id="description" placeholder="Description">{{ old('description')}}</textarea>
				  @if($errors->has('description'))
				<span class="help-block">
					<strong>{{ $errors->first('description') }}</strong>
				</span>
				@endif
			   
			  </div>
			</div>
		   <div class="form-group col-sm-10 col-sm-offset-1 has-feedback{{ $errors->has('image.*') ? ' has-error' : '' }}">
			  <label for="image" class="col-sm-3 control-label">Upload Document </label>
			  <div class="col-sm-9">
				<input type="file" value="" name="image[]" class="form-control" multiple="multiple">
				 @if($errors->has('image.*'))
				<span class="help-block">
					<strong>{{ $errors->first('image.*') }}</strong>
				</span>
				@endif
			</div>
		  </div>
		   
		   
		  </div>
		  <!-- /.box-body -->
		  <div class="box-footer">
			  <div class="col-sm-10 col-sm-offset-1">
				  <button type="submit" class="btn btn-success btn-flat">Submit</button>&nbsp;&nbsp;
				  <a href="#" class="btn btn-default btn-flat">Cancel</a>
			  </div>
		  </div>
		  <!-- /.box-footer -->
		</form>
	  </div>
	
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	{{-- <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" /> --}}
	
	{{-- <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script> --}}
	<script>
	  $(function(){
		  $('.select2').select2();
		  $('textarea.editor').wysihtml5();
	  });
	</script>
</body>
</html>
