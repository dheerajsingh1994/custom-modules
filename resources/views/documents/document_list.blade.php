@extends('layouts.admin')
@section('title', 'Admin|Documents')
@section('content')
    <div class="box">
        <div class="box-header">
          <!--<div class="alert alert-danger">
            <strong>Attention!</strong> Please select any one project for task allocation on <strong>Manual mode</strong>
          </div>-->
            <h3 class="box-title">All Documents</h3>
            <div class="pull-right">
                
               <!--<a href="javascript:void(0);" class="btn btn-default btn-flat btn-sm" data-toggle="modal" data-target="#projectFilterModal"> Apply Filter</a> -->
               <!-- Trigger the modal with a button -->
               
               <a href="{{route('vendor.upload.document')}}" class="btn btn-success btn-flat btn-sm"><i class="fa fa-plus"></i> Upload New Documnt </a> 
           

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
         

     @if (count($lists))

			<div class="table-responsive">
					<table id="data-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>S.N.</th>
								<th>Document Description</th>
                <th >Created at</th>
								<th>Actions</th>
							   
							</tr>
						</thead>
						<tbody>
							   
								@foreach ($lists as $document)
									<tr>
										<td>{{ $loop->iteration }} </td>
									
										<td>{!!$document->description!!} </td>
                     <td> {{ date('d M Y H:i A' , strtotime($document->created_at)) }}  </td>
                  
										
										 <td>
											
                         <a href="{{route('vendor.document.attachments' ,['id' => $document->id])}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Click to see all attcahments"><i class="fa fa-eye"></i></a>


										 </td>
									</tr>
							 @endforeach

						</tbody>
					   
					</table>
			</div>

              @else
                     <p class="empty-records">---No records found.---</p>
                    @endif 
            <div class="paginate-right"></div>
        </div>
        <!-- /.box-body -->




    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/css/dataTables.bootstrap.min.css') }}" />
@endsection
@section('scripts')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input1=$('input[name="from"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input1.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    
     
        var date_input2=$('input[name="to"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input2.datepicker({
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
 <script type="text/javascript">
     var taskListUrl = "{{route('project.task.list')}}";
 </script>
 <script src="{{ asset('js/projectController.js') }}"></script>
@endsection

