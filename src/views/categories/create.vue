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
    const name = ref("");
    const slug = ref("");
    const errors = ref([]);

    //method "storeCategory"
    const storeCategory = async () => {

        //init formData
        let formData = new FormData();

        //assign state value to formData
        formData.append("name", name.value);
        formData.append("slug", slug.value);

        //store data with API
        await api.post('/api/categories', formData)
        .then(() => {
            //redirect
            router.push({ path: "/categories" });
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
                        <form @submit.prevent="storeCategory">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Category Name">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Slug</label>
                                <input type="text" class="form-control" v-model="slug" placeholder="Category Slug">
                                <div v-if="errors.slug" class="alert alert-danger mt-2">
                                    <span>{{ errors.slug[0] }}</span>
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
