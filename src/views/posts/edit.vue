<script setup>
    //import ref
    import { ref, onMounted } from "vue";
 
    //import router
    import { useRouter, useRoute } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //init route
    const route = useRoute();
 
    //define state
    const category_id = ref("");
    const user_id = ref("");
    const slug = ref("");
    const thumbnail = ref(null);
    const title = ref("");
    const excerpt = ref("");
    const body = ref("");
    const status = ref("");
    const errors = ref([]);
 
    //onMounted
    onMounted(async () => {
        //fetch detail data post by ID
        await api.get(`/api/posts/${route.params.id}`)
            .then(response => {
                const data = response.data.data;
                //set response data to state
                category_id.value = data.category_id;
                user_id.value = data.user_id;
                slug.value = data.slug;
                title.value = data.title;
                excerpt.value = data.excerpt;
                body.value = data.body;
                thumbnail.value = data.thumbnail; 
                status.value = data.status;
            });
    });
 
    // //method for handle file changes
    // const handleFileChange = (e) => {
    //     //assign file to state
    //     thumbnail.value = e.target.files[0];
    // };

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            thumbnail.value = file; 
        }
    };
 
    //method "updatePost"
    const updatePost = async () => {
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("category_id", category_id.value);
        formData.append("user_id", user_id.value);
        formData.append("slug", slug.value);
        formData.append("thumbnail", thumbnail.value);
        formData.append("title", title.value);
        formData.append("excerpt", excerpt.value);
        formData.append("body", body.value);
        formData.append("status", status.value);
        formData.append("_method", "PATCH");
 
        //store data with API
        await api.post(`/api/posts/${route.params.id}`, formData)
            .then(() => {
                //redirect
                router.push({ path: "/posts" });
            })
            .catch((error) => {
                //assign response error data to state "errors"
                errors.value = error.response.data;
            });
    };
</script>
 
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updatePost()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category ID</label>
                                <input type="text" class="form-control" v-model="category_id" placeholder="Category ID">
                                <div v-if="errors.category_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.category_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">User ID</label>
                                <input type="text" class="form-control" v-model="user_id" placeholder="User ID">
                                <div v-if="errors.user_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.user_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" class="form-control" v-model="slug" placeholder="Slug">
                                <div v-if="errors.slug" class="alert alert-danger mt-2">
                                    <span>{{ errors.slug[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Image</label>
                                <input type="file" class="form-control" @change="handleFileChange($event)">
                                <!-- Preview Thumbnail -->
                                <img v-if="thumbnail" :src="thumbnail" alt="Thumbnail Preview" class="img-thumbnail mt-2" style="max-height: 200px;">
                                <div v-if="errors.thumbnail" class="alert alert-danger mt-2">
                                    <span>{{ errors.thumbnail[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" class="form-control" v-model="title" placeholder="Title">
                                <div v-if="errors.title" class="alert alert-danger mt-2">
                                    <span>{{ errors.title[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Excerpt</label>
                                <textarea class="form-control" v-model="excerpt" rows="3" placeholder="Excerpt"></textarea>
                                <div v-if="errors.excerpt" class="alert alert-danger mt-2">
                                    <span>{{ errors.excerpt[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Body</label>
                                <textarea class="form-control" v-model="body" rows="5" placeholder="Body"></textarea>
                                <div v-if="errors.body" class="alert alert-danger mt-2">
                                    <span>{{ errors.body[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <input type="text" class="form-control" v-model="status" placeholder="Status">
                                <div v-if="errors.status" class="alert alert-danger mt-2">
                                    <span>{{ errors.status[0] }}</span>
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
