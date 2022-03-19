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
            <a href="{{route('employee.upload.document')}}" class="btn-btn-primary">Add Document</a>
        </div>
        
        @if (count($lists))
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Document Description</th>
                            <th>Created at</th>
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
                            <a href="{{route('employee.document.attachments' ,['id' => $document->id])}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Click to see all attcahments">
                                Show
                            </a>
                    </td>
                </tr>
                @endforeach
                </tbody>        
            </table>
        </div>
        @else
            <p class="empty-records">---No records found.---</p>
        @endif 
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>