@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sidebar">
            <div class="listify">
                <img src="{{ URL('images/listify.png') }}" alt="Listify" class="listify-picture">
                <span class="logo-name">Listify</span>
            </div>
            <div class="menu">
                <div class="menu-item" onclick="redirectTo('/tasks')">
                    <span class="icon">📋</span>
                    <span class="menu-text">To Do</span>
                </div>
                <div class="menu-item" onclick="redirectTo('/completed')">
                    <span class="icon">✔️</span>
                    <span class="menu-text">Completed</span>
                </div>
            </div>
            <div class="new-list">
                <button class="new-list-button" onclick="addNewList()">+ New list</button>
            </div>
            <div class="max-list">
                <p>Max of 3 list</p>
            </div>
        </div>
        <div class="main-content">
            <h1>📋 To Do</h1>
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
         document.addEventListener('DOMContentLoaded', () => {
            initialize();
        });

        function initialize() {
            loadTasks();
            document.getElementById('addTaskButton').addEventListener('click', addTask);
            document.getElementById('taskInput').addEventListener('keypress', event => {
                if (event.key === 'Enter') addTask();
            });
        }

        function redirectTo(path) {
            window.location.href = path;
        }

        function loadTasks() {
            axios.get('/api/tasks')
                .then(response => {
                    const tasks = response.data.tasks;
                    tasks.forEach(task => appendTaskToTable(task));
                })
                .catch(error => console.error('Error loading tasks!', error));
        }

        function addTask() {
            const taskInput = document.getElementById('taskInput');
            const taskName = taskInput.value.trim();
            if (!taskName) {
                alert('Please enter a task name.');
                return;
            }

            axios.post('/api/tasks', { task_name: taskName, is_complete: 1 })
                .then(() => location.reload())
                .catch(error => console.error('Error adding task!', error));
        }
        
        function appendTaskToTable(task) {
            const todoTableBody = document.getElementById('todoTableBody');
            const taskRow = document.createElement('tr');
            taskRow.setAttribute('data-id', task.id);
            taskRow.innerHTML = `
                <td class="td1">
                    <input type="checkbox" class="task-checkbox" ${task.is_complete ? 'checked' : ''}>
                    ${task.task_name}
                </td>
                <td class="td2">${task.is_complete ? 'Completed' : 'Not Completed'}</td>
                <td class="action-buttons">
                    <button class="edit-btn" onclick="editTask(${task.id}, this)">✏️</button>
                    <button class="remove-btn" onclick="removeTask(${task.id}, this)">🗑️</button>
                </td>
            `;
            todoTableBody.appendChild(taskRow);

            taskRow.querySelector('.task-checkbox').addEventListener('change', function() {
                updateTaskStatus(task.id, this.checked ? 1 : 0, taskRow);
            });
        }

        function updateTaskStatus(taskId, isComplete, taskRow) {
            axios.put(`/api/tasks/${taskId}`, { is_complete: isComplete })
                .then(() => {
                    taskRow.children[1].textContent = isComplete ? 'Completed' : 'Not Completed';
                })
                .catch(error => console.error('Error updating task status!', error));
        }
        
        function editTask(taskId, button) {
            const row = button.closest('tr');
            const taskName = row.children[0].textContent.trim();
            const newTaskName = prompt('Enter new task name:', taskName);

            if (!newTaskName.trim()) {
                alert('Task name cannot be empty.');
                return;
            }

            axios.put(`/api/tasks/${taskId}/name`, { task_name: newTaskName })
                .then(() => {
                    const taskCheckbox = row.querySelector('.task-checkbox');
                    row.children[0].innerHTML = '';
                    row.children[0].appendChild(taskCheckbox);
                    row.children[0].innerHTML += ` ${newTaskName}`;
                })
                .catch(error => console.error('Error updating task!', error));
        }

        function removeTask(taskId, button) {
            const row = button.closest('tr');
            document.getElementById('todoTableBody').removeChild(row);

            axios.delete(`/api/tasks/${taskId}`)
                .catch(error => console.error('Error deleting task!', error));
        }
    </script>
@endsection