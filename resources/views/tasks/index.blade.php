@extends('layouts.app')

@section('content')
<div class="container">
        <div class="sidebar">
            <div class="listify">
                <img src="{{ URL('images/listify.png') }}" alt="Listify" class="listify-picture">
                <span class="logo-name">Listify</span>
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
                <button class="new-list-button">+ New list</button>
            </div>
        </div>
        <div class="main-content">
            <h1>☀️ To Do</h1>
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
                    <tbody id="todoTableBody">
                        <!-- Tasks will be appended here -->
                    </tbody>
                </table>
            </div>
            <div class="add-task">
                <input type="text" class="task-input" placeholder="Add New Task" id="taskInput">
                <button class="add-task-button" id="addTaskButton">Add</button>
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
            const taskInput = document.getElementById('taskInput');
            const addTaskButton = document.getElementById('addTaskButton');
            const todoTableBody = document.getElementById('todoTableBody');

            addTaskButton.addEventListener('click', () => {
                addTask();
                location.reload(); // Refresh the page
            });

            taskInput.addEventListener('keypress', event => {
                if (event.key === 'Enter') {
                    addTask();
                    location.reload(); // Refresh the page
                }
            });
            // Load tasks from the server when the page loads
            loadTasks();

            function loadTasks() {
                axios.get('/api/tasks')
                    .then(response => {
                        const tasks = response.data.tasks;
                        tasks.forEach(task => {
                            appendTaskToTable(task);
                        });
                    })
                    .catch(error => {
                        console.error('There was an error loading the tasks!', error);
                    });
            }

            function addTask() {
                const taskName = taskInput.value.trim();
                if (taskName === '') {
                    alert('Please enter a task name.');
                    return;
                }

                axios.post('/api/tasks', {
                    task_name: taskName,
                    is_complete: 1
                })
                .then(response => {
                    appendTaskToTable(response.data.task);
                    taskInput.value = '';
                })
                .catch(error => {
                    console.error('There was an error adding the task!', error);
                });
            }
            
            function appendTaskToTable(task) {
                const taskRow = document.createElement('tr');
                taskRow.setAttribute('data-id', task.id);
                taskRow.innerHTML = `
                    <td class="td1">
                        <input type="checkbox" class="task-checkbox" ${task.is_complete ? 'checked' : ''}>
                        ${task.task_name}
                    </td>
                    <td class="td2">${task.is_complete ? 'Completed' : 'Not Completed'}</td>
                    <td class="action-buttons">
                        <button class="edit-btn" onclick="editTask(this)">✏️</button>
                        <button class="remove-btn" onclick="removeTask(this)">🗑️</button>
                    </td>
                `;

                todoTableBody.appendChild(taskRow);

                const checkbox = taskRow.querySelector('.task-checkbox');
                checkbox.addEventListener('change', function() {
                    const taskId = taskRow.getAttribute('data-id');
                    const isComplete = checkbox.checked ? 1 : 0;

                    axios.put(`/api/tasks/${taskId}`, {
                        is_complete: isComplete
                    })
                    .then(response => {
                        // Update the status in the tableD
                        taskRow.children[1].textContent = isComplete ? 'Completed' : 'Not Completed';
                    })
                    .catch(error => {
                        console.error('There was an error updating the task status!', error);
                    });
                });
                
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
                    const taskCheckbox = row.children[0].querySelector('.task-checkbox');
                    row.children[0].innerHTML = '';
                    row.children[0].appendChild(taskCheckbox);
                    row.children[0].innerHTML += `<span class="task-name"> ${newTaskName}</span>`;
                })
                .catch(error => {
                    console.error('There was an error updating the task!', error);
                });
            };

            window.removeTask = function(button) {
                const row = button.parentElement.parentElement;
                const taskId = row.getAttribute('data-id');
                todoTableBody.removeChild(row);

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