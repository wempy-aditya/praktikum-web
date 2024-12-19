<script setup>
import { ref, onMounted } from "vue";
import api from "../api/index";

// State untuk posts dan error handling
const posts = ref([]);
const error = ref(null);

// Fungsi untuk fetch data dari API
const fetchPosts = async () => {
    try {
        const response = await api.get("/api/posts");
        posts.value = response.data.data.data;
    } catch (err) {
        console.error("Error fetching posts:", err);
        error.value = "Failed to load posts.";
    }
};

// Fetch posts saat komponen dimuat
onMounted(() => {
    fetchPosts();
});
</script>

<template>
    <div>
        <!-- Hero Carousel -->
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/public/bgimg5.jpg" class="d-block w-100"
                        alt="Welcome">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="fw-bold">Welcome to Our Blog</h1>
                        <p>Discover the latest posts and updates</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/public/bgimg6.jpg" class="d-block w-100"
                        alt="Explore">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="fw-bold">Explore Our Categories</h1>
                        <p>Find posts tailored to your interests</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/public/bgimg2.jpg" class="d-block w-100"
                        alt="Stay Updated">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="fw-bold">Stay Updated</h1>
                        <p>Never miss the latest posts and trends</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Posts Section -->
        <div class="container mt-5">
            <div class="row">
                <!-- Tampilkan pesan error jika ada -->
                <div v-if="error" class="col-md-12">
                    <div class="alert alert-danger">{{ error }}</div>
                </div>

                <!-- Iterasi posts untuk ditampilkan -->
                <div class="row" v-else>
                    <div v-for="post in posts" :key="post.id" class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-sm h-100">
                            <img :src="post.thumbnail" class="card-img-top" alt="Post Thumbnail" />
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><strong>{{ post.title }}</strong></h5>
                                <p class="card-text text-muted small">
                                    By {{ post.author.name }} in {{ post.category.name }}
                                </p>
                                <p class="card-text" v-html="post.excerpt"></p>
                                <a :href="`/post/${post.id}`" class="btn btn-primary btn-sm mt-auto">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.carousel-caption {
    /* background-color: rgba(0, 0, 0, 0.5);  */
    padding: 20px;
    border-radius: 10px;

    /* Pusatkan di tengah */
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    position: absolute;
    text-align: center;
    width: 60%;
}

.carousel-item img {
    object-fit: cover;
    height: 400px; /* Set a consistent height for the images */
    position: relative;
}

@media (max-width: 768px) {
    .carousel-caption h1 {
        font-size: 1.2rem; /* Lebih kecil di layar kecil */
    }
    .carousel-caption p {
        font-size: 0.9rem;
    }
}

.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}
</style>
