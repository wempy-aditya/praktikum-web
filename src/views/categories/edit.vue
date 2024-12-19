<script setup>
    import { ref, onMounted } from "vue";
    import { useRouter, useRoute } from 'vue-router';
    import api from "../../api";

    const router = useRouter();
    const route = useRoute();

    const id = ref("");
    const name = ref("");
    const slug = ref("");
    const errors = ref([]);

    // Fetch data kategori berdasarkan ID
    onMounted(async () => {
        try {
            const response = await api.get(`/api/categories/${route.params.id}`);
            const data = response.data.data;

            // Assign data ke state
            id.value = data.id;
            name.value = data.name;
            slug.value = data.slug;
        } catch (error) {
            console.error("Error fetching category data:", error);
        }
    });

    // Method untuk update kategori
    const updateCategory = async () => {
        try {
            // Buat JSON payload
            const payload = {
                name: name.value,
                slug: slug.value
            };

            // Kirim data ke API dengan metode PUT
            await api.put(`/api/categories/${route.params.id}`, payload, {
                headers: {
                    "Content-Type": "application/json"
                }
            });

            // Redirect ke halaman daftar kategori
            router.push({ path: "/categories" });
        } catch (error) {
            // Tangani error
            if (error.response && error.response.data) {
                errors.value = error.response.data.errors || {};
            } else {
                console.error("Error updating category:", error);
            }
        }
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateCategory()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" class="form-control" v-model="slug" placeholder="Slug">
                                <div v-if="errors.slug" class="alert alert-danger mt-2">
                                    <span>{{ errors.slug[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
