<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center ">
                    <router-link :to="{ name: 'home' }">HOME</router-link>
                    <router-link :to="{ name: 'create' }">CREATE</router-link>
                </h1>
                <div class="card">
                    <div class="card-header text-center mt-5 mb-5">
                        <h3>All authors with their books are here:</h3><br>
                    </div>
                </div>
                <button @click="showData()" class="btn btn-block btn-primary">Show/Hide data</button><br>
                <div v-if="displayData">      
                    <div class="card  mt-5 mb-5" v-for="author in authors" v-bind:key="author.id">
                        <div class="card-body alert-info text-center">
                            <div class="card-title">
                                <h1>Name: {{ author.name }} </h1> 
                                <p>(Address: {{author.address}} )</p>
                                <p>(age: {{ author.age }} )</p>
                            </div>
                            <div class="card mt-2 mb-2" v-for="book in author.books" v-bind:key="book.id">
                                <h5 class="card-body  alert-secondary"><small>Title: </small>{{ book.name }}</h5>
                                <small>(Released at: {{ book.release_date }})</small>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            authors: [],
            author: {
                id: '',
                name: '',
                age: '',
                address: '',
                books: [],
                book: {
                    id: '',
                    name: '',
                    release_date: '',
                    authors_id: ''
                },
            },
            author_id: '',
            displayData: false
        };
    },

    created() {
        this.fetchAuthorsWithBooks();
    },

    methods: {
        showData() {
            this.displayData = !this.displayData;
        },
        fetchAuthorsWithBooks() {
            fetch('api/authors-books')
            .then(res => res.json())
            .then(res => {
                this.authors = res;
            });
        }
    }
};
</script>