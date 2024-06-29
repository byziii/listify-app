@extends('layouts.complete_app')

@section('content')
<div class="container">
        <div class="sidebar">
            <div class="profile">
                <img src="path/to/profile-picture.jpg" alt="Profile Picture" class="profile-picture">
                <span class="username">Admin</span>
            </div>
            <div class="menu">
                <div class="menu-item" onclick="redirectToTasks()">
                    <span class="icon">☀️</span>
                    <span class="menu-text">To Do</span>
                </div>
                <div class="menu-item" onclick="redirectToCompleted()">
                    <span class="icon">✔️</span>
                    <span class="menu-text">Completed</span>
                </div>
            </div>
            <div class="new-list">
                <!-- No new list button here -->
            </div>
        </div>
        <div class="main-content">
            <h1>✔️ Completed</h1>
            <hr>
            <div class="todo-table-container">
                <table class="todo-table">
                    <thead>
                        <tr>
                            <th class="th1">Task</th>
                            <th class="th2">Status</th>
                            <th class="th3"> </th>
                        </tr>
                    </thead>
                    <tbody id="completedTableBody">
                        <!-- Tasks will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function redirectToTasks() {
            window.location.href = '/tasks'; // Redirect to tasks page
        }

        function redirectToCompleted() {
            window.location.href = '/completed'; // Redirect to completed tasks page
        }

        document.addEventListener('DOMContentLoaded', () => {
            const completedTableBody = document.getElementById('completedTableBody');

            // Load completed tasks from the server when the page loads
            loadCompletedTasks();

            function loadCompletedTasks() {
                axios.get('/api/tasks')
                    .then(response => {
                        const tasks = response.data.tasks;
                        tasks.forEach(task => {
                            if (task.is_complete) {
                                appendTaskToTable(task);
                            }
                        })
                    })
                    .catch(error => {
                        console.error('There was an error loading the tasks!', error);
                    });
            }

            function appendTaskToTable(task) {
                const taskRow = document.createElement('tr');
                taskRow.setAttribute('data-id', task.id);
                taskRow.innerHTML = `
                    <td class="td1">${task.task_name}</td>
                    </td>
                    <td class="td2">Completed</td>
                    <td class="action-buttons">
                        <button class="edit-btn" onclick="editTask(this)">✏️</button>
                        <button class="remove-btn" onclick="removeTask(this)">🗑️</button>
                    </td>
                `;

                completedTableBody.appendChild(taskRow);
            }

            window.editTask = function(button) {
                const row = button.parentElement.parentElement;
                const taskId = row.getAttribute('data-id');
                const taskName = row.children[0].textContent.trim();
                const newTaskName = prompt('Enter new task name:', taskName);

                if (newTaskName === null || newTaskName.trim() === '') {
                    alert('Task name cannot be empty.');
                    return;
                }

                axios.put(`/api/tasks/${taskId}/name`, {
                    task_name: newTaskName
                })
                .then(response => {
                    row.children[0].textContent = newTaskName;
                })
                .catch(error => {
                    console.error('There was an error updating the task!', error);
                });
            };

            window.removeTask = function(button) {
                const row = button.parentElement.parentElement;
                const taskId = row.getAttribute('data-id');
                completedTableBody.removeChild(row);

                axios.delete(`/api/tasks/${taskId}`)
                    .then(response => {
                        // Handle successful deletion
                    })
                    .catch(error => {
                        console.error('There was an error deleting the task!', error);
                    });
            }
        });
    </script>
@endsection