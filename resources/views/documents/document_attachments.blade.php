<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            @if(count($list->attachments))
              <?php $i=1; ?>
              @foreach($list->attachments as $attcahment)
              <div class="col-md-2" style="border: 1px solid #ccc"> 
              <a href="{{route('employee.document.delete' , ['id' => $attcahment->id])}}" data-toggle="tooltip" role="button" class="close" title="Click to delete" onClick="return confirm('Are you sure want to delete')" style="color: red;opacity: 1">&times;</a>
              <a href="{{ asset($attcahment->image) }}" target="_blank"><img src="{{ asset('img/cv.pdf') }}" class="img-responsive"></a>
            </div>
             @if($i==6)
              <div class="clearfix"></div>
              @endif
               
                <?php $i++ ;?>
               @endforeach
           @endif
           </div>    
    </div>    
</body>
</html>