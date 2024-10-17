const taskInput = document.getElementById('taskInput');
const taskList = document.getElementById('taskList');
const addTaskBtn = document.getElementById('addTaskBtn');

let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

// Function to render tasks
function renderTasks() {
    taskList.innerHTML = ''; // Clear the list before re-rendering

    tasks.forEach((task, index) => {
        const taskItem = document.createElement('li');

        const taskText = document.createElement('textarea');
        taskText.value = task.text;
        taskText.readOnly = true;
        taskText.classList.add('task-text');

        const editBtn = document.createElement('button');
        editBtn.textContent = 'Edit';
        editBtn.classList.add('editBtn');

        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';

        taskItem.appendChild(taskText);
        taskItem.appendChild(editBtn);
        taskItem.appendChild(deleteBtn);

        taskList.appendChild(taskItem);

        // Event listener for delete button
        deleteBtn.addEventListener('click', () => {
            tasks.splice(index, 1);
            saveAndRenderTasks();
        });

        // Event listener for edit button
        editBtn.addEventListener('click', () => {
            if (editBtn.textContent === 'Edit') {
                taskText.readOnly = false;
                taskText.focus();
                editBtn.textContent = 'Save';
            } else {
                taskText.readOnly = true;
                tasks[index].text = taskText.value;
                editBtn.textContent = 'Edit';
                saveAndRenderTasks();
            }
        });
    });
}

// Add new task
addTaskBtn.addEventListener('click', () => {
    const taskText = taskInput.value.trim();
    if (taskText !== '') {
        tasks.push({ text: taskText });
        taskInput.value = ''; // Clear the input field
        saveAndRenderTasks();
    }
});

document.getElementById("taskInput").addEventListener("keypress", function (event) {
    if (event.keyCode === 13) { 
        event.preventDefault(); 
        const taskText = taskInput.value.trim();
        if (taskText !== '') {
            tasks.push({ text: taskText });
            taskInput.value = ''; 
            saveAndRenderTasks();
        }
    }
});

// Save to local storage and re-render the list
function saveAndRenderTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
    renderTasks();
}

// Initial render
renderTasks();
