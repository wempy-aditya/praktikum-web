<script setup>
    // Import ref dan onMounted dari Vue
    import { ref, onMounted } from "vue";

    // Import useRoute dari Vue Router
    import { useRoute } from "vue-router";

    // Import API instance (Axios)
    import api from "../api";

    // Inisialisasi route
    const route = useRoute();

    // Definisikan state untuk menyimpan data post
    const post = ref({
        id: null,
        title: "",
        body: "",
        excerpt: "",
        thumbnail: "",
        category: { name: "" },
        author: { name: "" },
        created_at: "",
    });

    // State untuk loading spinner
    const loading = ref(true);

    // State untuk error handling
    const error = ref(null);

    // Fungsi untuk fetch detail post dari API
    const fetchPostDetail = async () => {
        try {
            const response = await api.get(`/api/posts/${route.params.id}`);
            post.value = response.data.data; // Set data post ke state
        } catch (err) {
            console.error("Error fetching post details:", err);
            error.value = "Failed to load post details. Please try again later.";
        } finally {
            loading.value = false; // Set loading ke false setelah fetch selesai
        }
    };

    // Panggil fetchPostDetail saat komponen dimount
    onMounted(fetchPostDetail);
</script>


<template>
    <br><br><br><br>
    <div class="container mt-5">
        <!-- Loading Spinner -->
        <div v-if="loading" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Loading post details...</p>
        </div>

        <!-- Error Handling -->
        <div v-if="error" class="alert alert-danger text-center">
            {{ error }}
        </div>

        <!-- Post Detail -->
        <div v-else class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Card Wrapper -->
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                    <!-- Thumbnail Post -->
                    <img
                        v-if="post.thumbnail"
                        :src="post.thumbnail"
                        alt="Post Thumbnail"
                        class="card-img-top img-fluid"
                        style="object-fit: cover; height: 350px;"
                    />

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <!-- Judul Post -->
                        <h1 class="fw-bold mb-3 text-center text-primary">{{ post.title }}</h1>

                        <!-- Informasi Tambahan -->
                        <p class="text-muted text-center small mb-4">
                            By <strong>{{ post.author.name }}</strong> in
                            <strong>{{ post.category.name }}</strong> | Published on
                            {{ new Date(post.created_at).toLocaleDateString("id-ID", { year: "numeric", month: "long", day: "numeric" }) }}
                        </p>

                        <!-- Konten Body -->
                        <div class="post-body lh-lg text-justify" v-html="post.body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
</template>





<!-- <style scoped>
.post-body {
    line-height: 1.8;
    font-size: 1rem;
    color: #333;
}

img {
    max-height: 500px;
    object-fit: cover;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}
</style> -->