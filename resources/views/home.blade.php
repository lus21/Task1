<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href = "{{asset('css/app.css')}}" />
	<link rel = "stylesheet" href = "{{asset('css/style.css')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>STDev Task1</title>
    </head>
    <body>
        <div class="container">
            <h2>Register</h2>
            <p>All fields must be filled,not empty:</p>
            <form action="/addUser" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" required="required">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" required="required">
                 </div>
                <div class="form-group">
                    <label for="keywords">Keywords:</label>
                    <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords: key1, key2" required="required">
                </div>
                <div class="form-group">
                    Select file to upload:
                    <label class="btn btn-info btn-file">
                    Browse <input type="file" name="fileToUpload" multiple id="fileToUpload" style="display: none;">
                    </label>
                </div>
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />            
                <input type="submit" class="btn btn-default" value="Add">
            </form>
            @if($msg=session('msg'))
                @if($msg==1)
                    <div class="panel panel-warning add_status">
                        <div class="panel-heading">Please fill all fields and attach your resume</div>
                    </div>
                @elseif($msg==2)
                    <div class="panel panel-warning add_status">
                        <div class="panel-heading">Upload doc(x),pdf or txt</div>
                    </div>
                @elseif($msg==3)
                <div class="panel panel-success add_status ">
                    <div class="panel-heading">Successfully added!</div>
                </div>
                 @elseif($msg==4)
                   <div class="panel panel-danger add_status">
                    <div class="panel-heading">Something went wrong,please try again</div>
                  </div>
                @endif
            @endif
        </div>
           
        <div class="container">
            <h2>Search</h2>
            <p>Search by first name,last name,or keywords:</p>
            <div class="form-inline search">
                <label for="ex1">First Name :</label>
                <input class="form-control" id="ex1" type="text" placeholder="First name">
            </div>
            <div class="form-inline search">
                <label for="ex2">Last Name :</label>
                <input class="form-control" id="ex2" type="text" placeholder="Last name">
            </div>
            <div class="form search">
                <label for="ex3">Keywords &nbsp;&nbsp;:</label>
                <input class="form-control keyword" id="ex3" type="text" placeholder="Keywords: key1, key2">
            </div>
               <button type="button" class="btn btn-info search_button">
                    <span class="glyphicon glyphicon-search"></span> Search
                </button>
            <div class="panel panel-info search no_results">
                <div class="panel-heading">Sorry,no results</div>
            </div>
        </div>
        
        
        <div class="container search_results">
            <h2>Search results</h2>          
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Keywords</th>
                        <th>Resume</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>     
    <script src = "{{asset('js/app.js')}}"></script>
    <script src = "{{asset('js/init.js')}}"></script>
    </body>
</html>
