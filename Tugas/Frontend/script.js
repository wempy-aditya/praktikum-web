const baseUrl = 'https://wempyaw.com/praktikum/modul4/Tugas/Backend/main.php/api/posts/';

// Fetch Posts from API
async function fetchPosts() {
    try {
        const response = await fetch(baseUrl);
        const data = await response.json();
        const postList = document.getElementById('postList');
        postList.innerHTML = '';

        // Check for successful response
        if (data.code === 200 && data.data.length > 0) {
            data.data.forEach(post => {
                const postCard = document.createElement('div');
                postCard.classList.add('post-card');
                postCard.innerHTML = `
                    <h3>${post.title}</h3>
                    <p>${post.content}</p>
                    <div class="meta-info">
                        <p>Author: ${post.author}</p>
                        <p>Category: ${post.category} | Date: ${new Date(post.created_at).toLocaleDateString()}</p>
                    </div>
                `;
                postList.appendChild(postCard);
            });
        } else {
            postList.innerHTML = '<p>No posts available at the moment.</p>';
        }
    } catch (error) {
        console.error("Error fetching posts:", error);
    }
}

// Load posts when the page is loaded
window.onload = fetchPosts;
