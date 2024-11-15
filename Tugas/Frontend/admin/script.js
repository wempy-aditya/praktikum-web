const baseUrl = 'https://wempyaw.com/praktikum/modul4/Tugas/Backend/main.php/api/posts';

async function fetchPosts() {
  const response = await fetch(baseUrl);
  const data = await response.json();
  const postList = document.getElementById('postList');
  postList.innerHTML = '';
  data.data.forEach(post => {
    postList.innerHTML += `
      <div class="post-card">
        <h3>${post.title}</h3>
        <p>Content: ${post.content}</p>
        <p>Author: ${post.author}</p>
        <p>Category: ${post.category}</p>
        <p>Status: ${post.status}</p>
        <div class="actions">
          <button class="btn-edit" onclick="showModal('edit', ${post.id}, '${post.title}', '${post.content}', '${post.author}', '${post.category}', '${post.status}')">Edit</button>
          <button class="btn-delete" onclick="deletePost(${post.id})">Delete</button>
        </div>
      </div>
    `;
  });
}

function showModal(mode, id = null, title = '', content = '', author = '', category = '', status='') {
  document.getElementById('postModal').style.display = 'flex';
  document.getElementById('modalTitle').textContent = mode === 'edit' ? 'Edit Post' : 'Add Post';
  document.getElementById('postId').value = id;
  document.getElementById('postTitle').value = title;
  document.getElementById('postContent').value = content;
  document.getElementById('postAuthor').value = author;
   document.getElementById('postCategory').value = category;
   document.getElementById(status).selected = "true";
}

function closeModal() {
  document.getElementById('postModal').style.display = 'none';
}

document.getElementById('postForm').onsubmit = async function (event) {
  event.preventDefault();
  const id = document.getElementById('postId').value;
  const title = document.getElementById('postTitle').value;
  const content = document.getElementById('postContent').value;
  const author = document.getElementById('postAuthor').value;
  const category = document.getElementById('postCategory').value;
  const status = document.getElementById('status').value;

  const method = id ? 'PUT' : 'POST';
  const url = id ? `${baseUrl}/${id}` : baseUrl;
  await fetch(url, {
    method: method,
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ title, content, author, category, status })
  });

  fetchPosts();
  closeModal();
};

async function deletePost(id) {
  if (confirm('Are you sure you want to delete this post?')) {
    await fetch(`${baseUrl}/${id}`, { method: 'DELETE' });
    fetchPosts();
  }
}

fetchPosts();
