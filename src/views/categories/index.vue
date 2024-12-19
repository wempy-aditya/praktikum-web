<script setup>
//import ref and onMounted
import { ref, onMounted } from 'vue';

//import api
import api from '../../api';

//define state
const categories = ref([]);

//method fetchDataCategories
const fetchDataCategories = async () => {

    //fetch data 
    await api.get('/api/categories')

    .then(response => {
        //set response data to state "categories"
        categories.value = response.data.data.data;
    })
    .catch((error) => {
        console.error("Failed to fetch categories:", error);
    });
};

//run hook "onMounted"
onMounted(() => {
    //call method "fetchDataCategories"
    fetchDataCategories();
});

//method deleteCategory
const deleteCategory = async (id) => {
    // Show confirmation dialog
    const isConfirmed = window.confirm("Are you sure you want to delete this category?");

    if (isConfirmed) {
        // Delete category with API
        await api.delete(`/api/categories/${id}`)
        .then(() => {
            // Call method "fetchDataCategories" to refresh the list
            fetchDataCategories();
        })
        .catch((error) => {
            console.error("Failed to delete category:", error);
        });
    }
};
</script>

<template>
    <br><br>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'categories.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW CATEGORY</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="categories.length == 0">
                                    <td colspan="4" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(category, index) in categories" :key="index">
                                    <td>{{ category.id }}</td>
                                    <td>{{ category.name }}</td>
                                    <td>{{ category.slug }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'categories.edit', params:{id: category.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteCategory(category.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>