<script setup>
    //import ref
    import { ref } from "vue";
 
    //import router
    import { useRouter } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //define state
    const thumbnail = ref("");
    const title = ref("");
    const slug = ref("");
    const excerpt = ref("");
    const body = ref("");
    const category_id = ref("");
    const user_id = ref("");
    const status = ref("");
    const errors = ref([]);
 
    //method for handle file changes
    const handleFileChange = (e) => {
        //assign file to state
        thumbnail.value = e.target.files[0];
    };
 
    //method "storePost"
    const storePost = async () => {
 
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("thumbnail", thumbnail.value);
        formData.append("title", title.value);
        formData.append("slug", title.value);
        formData.append("excerpt", excerpt.value);
        formData.append("body", body.value);
        formData.append("category_id", parseInt(category_id.value)); 
        formData.append("user_id", parseInt(user_id.value));
        formData.append("status", status.value);
 
        //store data with API
        await api.post('/api/posts', formData)
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
                        <form @submit.prevent="storePost()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Image</label>
                                <input type="file" class="form-control" @change="handleFileChange($event)">
                                <div v-if="errors.thumbnail" class="alert alert-danger mt-2">
                                    <span>{{ errors.thumbnail[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" class="form-control" v-model="title" placeholder="Title Post">
                                <div v-if="errors.title" class="alert alert-danger mt-2">
                                    <span>{{ errors.title[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" class="form-control" v-model="slug" placeholder="Slug Post">
                                <div v-if="errors.slug" class="alert alert-danger mt-2">
                                    <span>{{ errors.slug[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Excerpt</label>
                                <textarea class="form-control" v-model="excerpt" rows="2" placeholder="Excerpt Post"></textarea>
                                <div v-if="errors.excerpt" class="alert alert-danger mt-2">
                                    <span>{{ errors.excerpt[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Body</label>
                                <textarea class="form-control" v-model="body" rows="5" placeholder="Body Post"></textarea>
                                <div v-if="errors.body" class="alert alert-danger mt-2">
                                    <span>{{ errors.body[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Category</label>
                                <input type="number" class="form-control" v-model="category_id" placeholder="Category Post">
                                <div v-if="errors.category_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.category_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">User</label>
                                <input type="number" class="form-control" v-model="user_id" placeholder="User Post">
                                <div v-if="errors.user_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.user_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <input type="text" class="form-control" v-model="status" placeholder="Status Post">
                                <div v-if="errors.status" class="alert alert-danger mt-2">
                                    <span>{{ errors.status[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>