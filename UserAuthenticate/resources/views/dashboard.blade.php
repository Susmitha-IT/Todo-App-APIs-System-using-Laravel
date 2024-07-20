<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">TODO DASHBOARD</a>
            <a href="/logout" class="btn btn-outline-light">Logout</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Hello {{ session('user') }}!</h2><br>
        <div class="table-responsive">
        <table class="table table-striped" id="task-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Task rows will be injected here by JavaScript -->
            </tbody>
        </table>  
        </div>  
        <div class="card mb-3">
            <div class="card-header">
                Add Task
            </div>
            <div class="card-body">
                <form id="add-task-form">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" class="form-control" id="task" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
                <div id="add-task-response" class="mt-3"></div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            const apiKey = 'helloatg';
            function fetchTasks() {
                $.ajax({
                    url: '/todo/tasks',
                    method: 'GET',
                    headers: {
                        'API_KEY': apiKey
                    },
                    success: function(response) {
                        const tasks = response.tasks; 
                        let rows = '';
                        tasks.forEach(task => {
                            let statusColor = task.status === 'done' ? 'green' : 'red';
                            rows += `
                                <tr>
                                    <td>${task.id}</td>
                                    <td>${task.task}</td>
                                    <td style="text-transform: capitalize; color: ${statusColor};">${task.status}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm mark-done" data-id="${task.id}" ${task.status === 'done' ? 'style="display: none;"' : ''}>Mark Done</button>
                                        <button class="btn btn-warning btn-sm mark-pending" data-id="${task.id}" ${task.status === 'pending' ? 'style="display: none;"' : ''}>Mark Pending</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#task-table tbody').html(rows);
                    },
                    error: function(xhr) {
                        alert('Error fetching tasks: ' + xhr.responseJSON.message);
                    }
                });
            }
            fetchTasks();

            
            $('#add-task-form').on('submit', function(e) {
                e.preventDefault();

                const task = $('#task').val();

                $.ajax({
                    url: '/todo/add',
                    method: 'POST',
                    headers: {
                        'API_KEY': apiKey
                    },
                    data: {
                        task: task,
                        user_id: "{{ session('user_id') }}"
                    },
                    success: function(response) {
                        $('#add-task-response').html(`<div class="alert alert-success">${response.message}</div>`);
                        fetchTasks(); // Refresh the task list
                        $('#task').val(''); 
                    },
                    error: function(xhr) {
                        $('#add-task-response').html(`<div class="alert alert-danger">${xhr.responseJSON.message}</div>`);
                    }
                });
            });

            function updateTaskStatus(taskId, status) {
                $.ajax({
                    url: '/todo/status',
                    method:'POST',
                    headers: {
                        'API_KEY': apiKey
                    },
                    data: {
                        task_id: taskId,
                        status: status
                    },
                    success: function(response) {
                        fetchTasks(); 
                    },
                    error: function(xhr) {
                        alert('Error updating task status: ' + xhr.responseJSON.message);
                    }
                });
            }

            $('#task-table').on('click', '.mark-done', function() {
                const taskId = $(this).data('id');
                updateTaskStatus(taskId, 'done');
            });

            $('#task-table').on('click', '.mark-pending', function() {
                const taskId = $(this).data('id');
                updateTaskStatus(taskId, 'pending');
            });
    });
    </script>
</body>
</html>
