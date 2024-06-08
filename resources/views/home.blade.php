@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-12 mt-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="heading ">
                            <h4 class="text-center">All Posts</h5>
                                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
                        </div>

                        <div class="col-md-12 p-2">
                            <h5>Search Post</h5>
                            <div class="d-flex">
                                <div class="col-3">
                                    <select class="form-select" aria-label="Default select example" id="category" onChange="getPosts()">
                                    <option value="null">Categories</option>
                                          @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >
                                                            {{ $category->name }}
                                                        </option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-3 m-1">
                                    <select class="form-select" aria-label="Default select example" id="subcategory" onChange="getPosts()">
                                        <option value="null">SubCategories</option>
                                        @foreach($subCategories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }} >
                                                            {{ $category->name }}
                                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 m-1">
                                     <input type="text" id="date-range-picker" class="form-control" name="daterange" onChange="getPosts()"/>
                                </div>
                                <div class="col-3 m-1">
                                <input type="text" id="guest_number" class="form-control" name="guest_number" placeholder="guest_number" onChange="getPosts()"/>
                                </div>
                            </div>
                            <div class="col-3 mt-4 m-auto">
                                <button class="btn btn-primary w-50" onClick="clearFilter()">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Tile</th>
                                <th scope="col">Content</th>
                                <th scope="col">Image</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Guest Number</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Moment.js -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<!-- DateRangePicker -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

<script>
    var start_date=null;
    var end_date =null;
    var category = null;
    var subcategory =null;
    var guest_number = null;
    
    function showTable(data) {
            const tableBody = document.getElementById('tbody');   
        tableBody.innerHTML = "";
        data.posts.forEach(function(post) {
        const row = document.createElement("tr");
            const Id = document.createElement("td");
            Id.textContent =post.id;

            const Title = document.createElement("td");
            Title.textContent = post.title;

            const Content = document.createElement("td");
            Content.textContent = post.content;

            const image = document.createElement("td");
            const imgTag = document.createElement("img");
            imgTag.src = `/storage/${post.image}`;
            imgTag.alt = "Post Image";
            imgTag.style.maxHeight = "50px"; 
            image.appendChild(imgTag);
            const start_date = document.createElement("td");
            start_date.textContent = post.start_date;

            const end_date = document.createElement("td");
            end_date.textContent = post.end_date;

            const guest_number = document.createElement("td");
            guest_number.textContent = post.guest_numbers;

            
            const category = document.createElement("td");
            category.textContent = post.category.name;

            const action = document.createElement("td");
            action.innerHTML =
            `<button class='btn btn-sm btn-primary btn-edit'  value=${post.id}  data-sid=${post.id}>Edit</button>` +
            `<button class='btn btn-sm btn-danger btn-del' value=${post.id} data-sid=${post.id}>Delete</button>`;

            row.appendChild(Id);
            row.appendChild(Title);
            row.appendChild(Content);
            row.appendChild(image);
            row.appendChild(start_date);
            row.appendChild(end_date);
            row.appendChild(guest_number);
            row.appendChild(category);
            row.appendChild(action);

            tableBody.appendChild(row);
                            
        });
     
}
    function getPosts()
    {
        category = document.getElementById("category").value;
        subcategory = document.getElementById('subcategory').value;
        guest_number = document.getElementById('guest_number').value;
        var dataToSend = {
            category:category,
            start_date:start_date,
            end_date:end_date,
            subcategory:subcategory,
            guest_number:guest_number
        };
        var tBody = $("tbody");
        tBody.html("");
        $.ajax({
            url: 'api/posts',
            type: 'GET',
            data: dataToSend,
            dataType: 'json',
            success: function (data) {
                showTable(data);
                load();         
      },
      error: function (xhr, status, error) {
        alert(error);
      },
        });
    }
    $(document).ready(function() {
        getPosts();
        getDate();
        $('#date-range-picker').daterangepicker({
            opens: 'left', // Adjust the calendar position
            locale: {
                format: 'YYYY-MM-DD', // Define your desired date format
            }
        });
    });

    function getDate()
    {
        $('#date-range-picker').on('apply.daterangepicker', function(ev, picker) {
            // Access the selected range
             start_date = picker.startDate.format('YYYY-MM-DD');
             end_date = picker.endDate.format('YYYY-MM-DD');
             getPosts();
        });
       
    }

    // delete Data
function recordDelete(Id) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    const dataToSend ={id:Id};
    $.ajax({
            url: '/posts/delete',
            type: 'POST',
            data: dataToSend,
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            },
            success: function (data) {
                getPosts();     
        },
            error: function (xhr, status, error) {
                alert(error);
        },
    });
}

function load() {
  var deletBtn = document.getElementsByClassName("btn-del");
  var editBtn = document.getElementsByClassName("btn-edit");
//   console.log(deletBtn);
  for (
    let index = 0, i = 0;
    index < deletBtn.length, i < editBtn.length;
    index++, i++
  ) {
    deletBtn[index].addEventListener("click", function () {
      let id = deletBtn[index].getAttribute("data-sid");
    //   console.log(id);
      recordDelete(id);
    });

     // edit Function call
     editBtn[i].addEventListener("click", function () {
      let editId = editBtn[i].getAttribute("value");
      editUser(editId);
    });
  }
}

function editUser(Id) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    const dataToSend ={id:Id};
    window.location.href = "/posts/edit/" + Id;
}

function clearFilter()
{
    var dataToSend = {
            category:null,
            start_date:null,
            end_date:null,
            subcategory:null,
            guest_number:null
        };
        var tBody = $("tbody");
        tBody.html("");
        $.ajax({
            url: 'api/posts',
            type: 'GET',
            data: dataToSend,
            dataType: 'json',
            success: function (data) {
                showTable(data);
                    load();
                    $('#category').val('null');
                    $('#subcategory').val('null');
                    // Clear the date range picker
                    $('#date-range-picker').val('');

                // Clear the guest number input
                $('#guest_number').val('');
                    
        // });
                
      },
      error: function (xhr, status, error) {
        alert(error);
      },
        });
}
</script>
