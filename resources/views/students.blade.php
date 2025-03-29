@extends('layout')

<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

@section('content')
<div class="container">
    <h2 class="mt-4">Manage Students</h2>

    <!-- Add Student Button for populating modal-->
    <button type="button" class="btn btn-primary mb-3" id="addStudentBtn">
        <i class="fas fa-plus"></i> Add Student
    </button>

    <!-- Student Table -->
    <div class="table-responsive">

        <table id="studentTable" class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<!-- Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="editStudentId" name="id">

                        <div class="col-md-6 mb-3">
                            <label for="studentName" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="studentEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="studentEmail" name="email" required>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="studentCourse" class="form-label">Course</label>
                            <select class="form-select" id="studentCourse" name="course" required>
                                <option value="">Select Course</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Electronics">Electronics</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="studentPhone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="studentPhone" name="phone" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <div>
                                <input type="radio" id="male" name="gender" value="Male">
                                <label for="male">Male</label>

                                <input type="radio" id="female" name="gender" value="Female">
                                <label for="female">Female</label>

                                <input type="radio" id="other" name="gender" value="Other">
                                <label for="other">Other</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="studentDOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="studentDOB" name="dob" required>
                        </div>
                    </div>

                    <button type="submit" id="StudentBtn" class="btn btn-success">Add Student</button>
                    <button type="button" id="updateStudentBtn" class="btn btn-warning" style="display: none;">Update
                        Student</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- jQuery (DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap JS  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script>
    let studentTable;
    $(document).ready(function() {
        studentTable = $('#studentTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: "/get-data",
                type: "GET",

            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'course'
                },
                {
                    data: 'gender'
                },
                {
                    data: 'dob'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `
            <button class="btn btn-warning btn-sm editStudent" 
                data-id="${data}" 
                data-name="${row.name}" 
                data-email="${row.email}" 
                data-course="${row.course}" 
                data-gender="${row.gender}" 
                data-dob="${row.dob}" 
                data-phone="${row.phone}">
                <i class="fas fa-edit"></i>
            </button>

            <button class="btn btn-danger btn-sm" onclick="deleteStudent(${data})">
                <i class="fas fa-trash"></i>
            </button>
        `;
                    }
                }

            ]
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#addStudentBtn').click(function(e) {
            $('#addStudentModal').modal('show');
            $('#addStudentForm')[0].reset();
            $('#StudentBtn').show();
            $('#updateStudentBtn').hide();
        });

       
        // form submission for adding student
        $('#addStudentForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('student.store') }}",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    Swal.fire("Success", "Student added successfully!", "success");

                    $('#addStudentModal').modal('hide');
                    $('#addStudentForm')[0].reset();
                    studentTable.ajax.reload();
                },
                error: function() {

                    Swal.fire("Error", "Something went wrong!", "error");

                }
            });
        });



        
        // edit button click
        $(document).on("click", ".editStudent", function() {
            $('#editStudentId').val($(this).data('id'));
            $('#studentName').val($(this).data('name'));
            $('#studentEmail').val($(this).data('email'));
            $('#studentCourse').val($(this).data('course'));
            $('#studentDOB').val($(this).data('dob'));
            $('#studentPhone').val($(this).data('phone'));

            let genderValue = $(this).data('gender');
            $("input[name='gender']").prop('checked', false);
            $("input[name='gender'][value='" + genderValue + "']").prop('checked', true);

            $('#addStudentModal').modal('show');

            $('#StudentBtn').hide();
            $('#updateStudentBtn').show();
        });

        $('#updateStudentBtn').click(function() {
            var studentId = $('#editStudentId').val();

            var formData = {
                name: $('#studentName').val(),
                email: $('#studentEmail').val(),
                course: $('#studentCourse').val(),
                gender: $("input[name='gender']:checked").val(),
                dob: $('#studentDOB').val(),
                phone: $('#studentPhone').val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: "/students/update/" + studentId,
                type: "PUT",
                data: formData,
                success: function(response) {
                    Swal.fire("Success", "Student Updated successfully!", "success");
                    $('#addStudentModal').modal('hide');
                    studentTable.ajax.reload();
                },
                error: function() {
                    Swal.fire("Error", "Something went wrong!", "error");

                }
            });
        });


    });
</script>

<script>
    function deleteStudent(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/students/delete/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Deleted!", "Student has been deleted.", "success");
                            studentTable.ajax.reload();
                        } else {
                            Swal.fire("Error!", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire("Error!", "Something went wrong while deleting the student.", "error");
                    }
                });
            }
        });
    }
</script>
@endsection